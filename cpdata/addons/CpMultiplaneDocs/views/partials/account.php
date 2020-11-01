<div>
    <ul class="uk-breadcrumb">
        @hasaccess?('cockpit', 'accounts')
        <li><a href="@route('/settings')">@lang('Settings')</a></li>
        <li><a href="@route('/accounts')">@lang('Accounts')</a></li>
        @endif
        <li class="uk-active"><span>@lang('Account')</span></li>
    </ul>
</div>

<div class="uk-width-medium-1-2" riot-view>
    <p>@lang('Accounts are disabled')</p>
</div>
