<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <h4 class="card-header announcement_title text-center"><i class="far fa-bell"></i> Leave Announcement</h4>
            @forelse ($leave_announcement as $leave_announce)
                <div class="card-body announcement_card d-flex">
                    <img src="{{ asset($leave_announce->user->image_url) }}" class="rounded-circle mr-3" alt="" style="width: 50px; height: 50px;">
                    <div>
                        <p class="card-text mb-3">
                            <strong>Dear {{ $leave_announce->user->department->title  }} Team,</strong> <br>
                            {{ ucfirst($leave_announce->user->name) }} is on vacation from
                            <mark>{{ (new DateTime($leave_announce->start_date))->format('M j, Y') }}</mark>
                            to <mark>{{ (new DateTime($leave_announce->end_date))->format('M j, Y') }}</mark>
                            .
                            They may not be available during this period. We appreciate
                            your understanding.
                        </p>

                        <p class="card-text mb-2"><strong>Best regards,</strong></p>
                        <p class="card-text mb-0">
                            @if(App\Models\Settings::get('title'))
                                {{ App\Models\Settings::get('title') }}
                            @else
                                NewEx Ltd.
                            @endif
                        </p>
                    </div>
                </div>
            @empty
                <p class="pl-3 text-center pt-2">No Leave Announcement Today</p>
            @endforelse
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h4 class="card-header announcement_title text-center"><i class="far fa-bell"></i> Birthday Announcement</h4>
            @forelse ($birthday_announcement as $birthday)
                <div class="card-body announcement_card d-flex">
                    <img src="{{ asset($birthday->image_url) }}" class="rounded-circle mr-3" alt="" style="width: 50px; height: 50px;">
                    <div>
                        <p class="card-text anniversary_font_size">
                            <strong class="text-bold user_name_customize">Happy
                                Birthday {{ucfirst($birthday->name)}}</strong>,<br>
                            Today is the birthday
                            (<mark>{{ Carbon\Carbon::parse($birthday->date_of_birth)->format('d-m-Y') }}</mark>) of
                            the person who is spreading joy and positivity all around. May your
                            birthday and your life be as wonderful as you are!
                        </p>

                        <p class="card-text mb-2"><strong>Best regards,</strong></p>
                        <p class="card-text mb-0">
                            @if(App\Models\Settings::get('title'))
                                {{ App\Models\Settings::get('title') }}
                            @else
                                NewEx Ltd.
                            @endif
                        </p>
                    </div>
                </div>
            @empty
                <p class="pl-3 text-center pt-2">No Birthday Announcement Today</p>
            @endforelse
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h4 class="card-header announcement_title text-center"><i class="far fa-bell"></i> Joining Announcement</h4>
            @forelse ($joining_announcement as $joining)
                <div class="card-body announcement_card d-flex">
                    <img src="{{ asset($joining->image_url) }}" class="rounded-circle mr-3" alt="" style="width: 50px; height: 50px;">
                    <div>
                        <p class="card-text anniversary_font_size">
                            <strong class="text-bold user_name_customize">{{ ucfirst($joining->name) }}</strong>,<br>
                            Thanks for being a part of our team (<mark>{{ Carbon\Carbon::parse($joining->hire_date)->format('d-m-Y') }}</mark>)! Today marks another year since
                            you joined us, and we appreciate your hard work and dedication.
                            Here's to more successful years ahead!
                        </p>

                        <p class="card-text mb-2"><strong>Best regards,</strong></p>
                        <p class="card-text mb-0">
                            @if(App\Models\Settings::get('title'))
                                {{ App\Models\Settings::get('title') }}
                            @else
                                NewEx Ltd.
                            @endif
                        </p>
                    </div>
                </div>
            @empty
                <p class="pl-3 text-center pt-2">No Joining Announcement Today</p>
            @endforelse
        </div>
    </div>
</div>
