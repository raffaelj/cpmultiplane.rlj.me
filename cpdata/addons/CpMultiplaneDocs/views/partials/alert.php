@foreach($mpdocs_alert as $idx => $error)
<div class="uk-panel uk-panel-box uk-panel-header" if="{ !hide_mpdocs_alert_{{$idx}} }">
    <p class="uk-panel-title">
        <i class="uk-icon-warning uk-text-danger"></i> <code>{{ $error['file'] }}</code>
    </p>
    <p class="">{{ $error['message'] }}</p>
    <field-boolean bind="hide_mpdocs_alert_{{$idx}}" label="Hide"></field-boolean>
    <a class="uk-button" href="@route('/collections/revisions/'.$collection)/{entry._id}">@lang('Revisions')</a>
    <button class="uk-button uk-button-primary" onclick="{ submit }">@lang('Save')</button>
</div>
@endforeach
