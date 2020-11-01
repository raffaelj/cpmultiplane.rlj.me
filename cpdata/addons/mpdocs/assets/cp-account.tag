<cp-account>

    <span class="uk-icon-spinner uk-icon-spin" show="{!opts.account}"></span>

    <span class="uk-flex-inline uk-flex-middle" if="{opts.account}">
        <cp-gravatar alt="{opts.account || 'Unknown'}" size="{ opts.size || 25 }"></cp-gravatar>
        <span class="uk-margin-small-left" if="{ opts.label !== false}" >{ opts.account || 'Unknown' }</span>
    </span>

</cp-account>
