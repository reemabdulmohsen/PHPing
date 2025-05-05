<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use App\Mail\WeeklyRoast;
use Illuminate\Support\Facades\Http;
class SendWeeklyRoast implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();
        foreach ($users as $user){
            $tasks = Task::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subWeek(1))
            ->get();

            $taskList = $tasks->map(function($task){
                return $task->name . " - " . ($task->is_completed ? "completed" : "not completed");
            })->implode("\n");

            $roast = $this->getRoast($taskList);
        
            Mail::to($user->email)->send(new WeeklyRoast($roast, $user));
        }
        //
    }
    private function getRoast($taskList){

        $prompt = "Here's what the user got done this week: {$taskList}. Now roast them with a short, ruthless summary of their productivity. Make it hurt—but make it funny.";

            $response = Http::withToken(config('services.openai.key'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a sarcastic assistant who roasts user productivity.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
            
            ]);
            logger()->info($response->json());
            $roast = $response['choices'][0]['message']['content'] ?? 'You got off easy this week 😅.'; 
            return $roast;
    }
}
