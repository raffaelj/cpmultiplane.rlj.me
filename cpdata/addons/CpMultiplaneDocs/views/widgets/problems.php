
<div>

    <div class="uk-panel-box uk-panel-card">

        <div class="uk-panel-box-header">
            <strong class="uk-panel-box-header-title">
            @lang('To do')
            </strong>
        </div>

        <div class="uk-grid uk-grid-small uk-grid-match">
        @foreach($todos as $lang => $todo)
            <div class="uk-width-1-2">
                <div class="uk-panel-box uk-panel-card">
                    <div class="uk-panel-box-header uk-flex uk-flex-middle">
                        <strong class="uk-panel-box-header-title uk-flex-item-1">
                            {{ $lang }}
                        </strong>
                        <span class="uk-badge uk-flex uk-flex-middle">{{ count($todo) }}</span>
                    </div>

                    <div class="uk-margin {{ count($todo) > 6 ? 'uk-scrollable-box' : '' }}">

                        <ul class="uk-list uk-list-space uk-margin-top">
                            @foreach($todo as $col)
                            <li>
                                <a href="@route('/collections/entry/pages/'.$col['_id'])?lang={{$lang}}" class="uk-text-muted">
                                    <i class="uk-icon-edit"></i>
                                    {{ htmlspecialchars($col['title']) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        @endforeach
        </div>

      @if(count($problems))
        <div class="uk-flex">
            <strong class="uk-panel-box-header-title uk-flex-item-1">
                @lang('Problems')
            </strong>
            <span class="uk-badge uk-flex uk-flex-middle">{{ count($problems) }}</span>
        </div>

        <div class="uk-margin {{ count($problems) > 5 ? 'uk-scrollable-box' : '' }}">

            <ul class="uk-list uk-list-space uk-margin-top">
                @foreach($problems as $col)
                <li>
                    <a href="@route('/collections/entry/pages/'.$col['_id'])" class="uk-text-muted">
                        <i class="uk-icon-edit"></i>
                        {{ htmlspecialchars($col['title']) }}
                    </a>
                </li>
                @endforeach
            </ul>

        </div>
      @endif

    </div>

</div>
