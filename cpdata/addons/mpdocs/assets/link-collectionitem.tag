<link-collectionitem>
<!-- customized collection link modal for html editor -->
    <div class="uk-modal-header uk-text-large">
        { App.i18n.get('Link Collection Item') }
    </div>

    <form ref="form" class="uk-form">

        <div class="uk-form-row uk-grid">
        <div class="uk-width-3-4">
            <label class="uk-text-small">{ App.i18n.get('Collection') }</label>

            <div class="uk-margin-top uk-text-large" show="{ !collections }">
                <i class="uk-icon-spinner uk-icon-spin"></i>
            </div>

            <div class="uk-margin-small-top" show="{collections}" data-uk-dropdown="mode:'click'">

                <a>{collection ? collections[collection].label || collection : App.i18n.get('Select collection...') }</a>

                <div class="uk-dropdown">
                    <ul class="uk-nav uk-nav-dropdown uk-dropdown-close">
                        <li class="uk-nav-header">{ App.i18n.get('Collections') }</li>
                        <li each="{meta, name in collections}">
                            <a onclick="{parent.selectCollection}" name="{name}">{meta.label || name}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="uk-width-1-4">
            <label class="uk-text-small">{ App.i18n.get('Language') }</label>
            <select bind="lang" onchange="{ selectLang }">
                <option value="en">en</option>
                <option value="de">de</option>
            </select>
        </div>
        </div>

        <div id="frmSelectCollectionLink" class="uk-form-row" if="{collection}">

            <label class="uk-text-small">{ App.i18n.get('Items') }</label>

            <div class="uk-margin-top uk-text-large" show="{ !items }">
                <i class="uk-icon-spinner uk-icon-spin"></i>
            </div>

            <div class="uk-margin-small-top" show="{ Array.isArray(items) }">

                <div class="uk-form-icon uk-form uk-width-1-1 uk-text-muted">
                    <i class="uk-icon-search"></i>
                    <input class="uk-width-1-1 uk-form-large uk-form-blank" type="text" ref="txtfilter" placeholder="{ App.i18n.get('Filter items...') }" onchange="{ updatefilter }">
                </div>

                <div class="uk-scrollable-box" show="{items && items.length}">

                    <ul class="uk-list">
                        <!--<li class="uk-margin-small-top uk-text-truncate" each="{item in items}">
                            <a onclick="{ parent.apply }"><i class="uk-icon-file-text-o"></i> { item.title || item.name || 'n/a' }</a>
                        </li>-->

                        <!--custom-->
                        <li class="uk-margin-small-top uk-text-truncate" each="{item in items}">
                            <a onclick="{ parent.apply }"><i class="uk-icon-file-text-o"></i> { item.title || item.name || 'n/a' }</a>
                            <span class="uk-text-muted">/{lang}/{ item.startpage ? '' : item.slug }</span>
                        </li>
                        <!--custom-->
                    </ul>
                </div>

                <div class="uk-button-group uk-margin-small-top uk-flex uk-flex-middle" show="{items && items.length}">

                    <ul class="uk-breadcrumb uk-margin-remove">
                        <li class="uk-active"><span>{ page }</span></li>
                        <li data-uk-dropdown="mode:'click'">

                            <a><i class="uk-icon-bars"></i> { pages }</a>

                            <div class="uk-dropdown">

                                <strong class="uk-text-small">{ App.i18n.get('Pages') }</strong>

                                <div class="uk-margin-small-top { pages > 5 ? 'uk-scrollable-box':'' }">
                                    <ul class="uk-nav uk-nav-dropdown">
                                        <li class="uk-text-small" each="{k,v in new Array(pages)}"><a class="uk-dropdown-close" onclick="{ parent.loadpage.bind(parent, v+1) }">{App.i18n.get('Page')} {v + 1}</a></li>
                                    </ul>
                                </div>
                            </div>

                        </li>
                    </ul>

                    <a class="uk-button uk-button-link uk-button-small" onclick="{ loadpage.bind(this, page-1) }" if="{page-1 > 0}">{ App.i18n.get('Previous') }</a>
                    <a class="uk-button uk-button-link uk-button-small" onclick="{ loadpage.bind(this, page+1) }" if="{page+1 <= pages}">{ App.i18n.get('Next') }</a>
                </div>

                <div class="uk-alert" show="{ items && !items.length }">No items found</div>
            </div>
        </div>

        <div class="uk-form-row">
            <label class="uk-text-small">Title</label>
            <input ref="title" type="text" class="uk-width-1-1 uk-form-large" required>
        </div>

        <div class="uk-form-row">
            <label class="uk-text-small">Url</label>
            <input ref="url" type="text" class="uk-width-1-1 uk-form-large" onkeyup="{ update }" required>
        </div>
    </form>
    <div class="uk-modal-footer uk-text-right">
        <button class="uk-button uk-button-primary uk-margin-right uk-button-large js-create-button" onclick="App.$('#frmSelectCollectionLink').submit()" show="{val('url')}">{App.i18n.get('Select')}</button>
        <button class="uk-button uk-button-link uk-button-large uk-modal-close">{App.i18n.get('Cancel')}</button>
    </div>

    <script>

        var $this = this;

        this.count = 0;
        this.page = 1;
        this.pages = 1;

        // custom
        this.lang = 'en';
        // custom

        App.request('/collections/_collections').then(function (data) {
            $this.collections = data;
            $this.update();

            // custom
            $this.selectCollection({item:{name:'pages'}});
            // custom
        });

        this.on('mount', function () {

            App.$(this.refs.form).on('submit', function (e) {

                e.preventDefault();
                $this.parent.opts.release({ url: $this.refs.url.value, title: $this.refs.title.value });
                $this.parent.opts.dialog.hide();
            });
        })

        // custom
        this.selectLang = function (e) {
            this.lang = e.target.value;
            this.page = 1;
            this.load();
        }.bind(this)
        // custom

        this.selectCollection = function (e) {
            this.collection = e.item.name;
            this.filter = '';
            this.page = 1;
            this.load();
        }.bind(this)

        this.apply = function (e) {
            //this.refs.url.value = 'collection://' + this.collection + '/' + e.item.item._id;
            this.refs.title.value = e.item.item.title || e.item.item.name || '';

            // custom
            this.refs.url.value = '/' + this.lang + '/' + (e.item.item.startpage ? '' : e.item.item.slug);
            // custom

        }.bind(this)

        this.val = function (ref) {
            return this.refs[ref] && this.refs[ref].value;
        }.bind(this)

        this.updatefilter = function (e) {
            this.filter = e.target.value;
            this.page = 1;
            this.load();
        }.bind(this)

        this.loadpage = function (page) {
            this.page = page > this.pages ? this.pages : page;
            this.load();
        }.bind(this)

        this.load = function () {

            this.items = null;

            var options = {
                limit: 20
            };

            if (this.filter) {
                options.filter = this.filter;
            }

            options.skip = (this.page - 1) * options.limit;

            // custom
            options.lang = this.lang;
            // custom

            App.request('/collections/find', { collection: this.collection, options: options }).then(function (data) {

                this.items = data.entries;
                this.page = data.page;
                this.pages = data.pages;
                this.count = data.count;
                this.update();

            }.bind(this))
        }.bind(this)

    </script>
</link-collectionitem>
