@component('mail::message')
# Your Weekly Roast 🔥🔥🔥

Hello {{ $user->name }},

{{ $roast }}


Don't feel bad, next week is a new chance to underperform! 🤣

Sincerely (with mild disappointment),<br>
RoastBot 🤖 
@endcomponent
