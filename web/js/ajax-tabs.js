$(document).ready(function() {
    $('[data-toggle="tabajax"]').on("click",function(e) {
        var $this = $(this),
            loadurl = $this.attr('href'),
            targ = $this.attr('data-target');

        window.location.href = '#' + $this.attr('id')
        $.get(loadurl, function(data) {
            $(targ).html(data).appendTo(targ);
            reloadDOM()

            $this.tab('show');
        });




        return false;
    });
    reloadTabs()
});

function reloadDOM() {
    removeNotice() //add to dom after ajax call
    loadConversation()
}

function removeNotice() {
    $('a[class="remove_notice"]').on("click",function(e){
        e.preventDefault();

        var url = $(this).attr('href');

        $.get(url, function() {
           reloadTabs()
        });

    });
}

function reloadTabs() {
    var regExp = /^#[A-z]+tab$/;
    var matches = regExp.exec(window.location.hash);
    var def = '#my_notices_tab'
    var url = matches === null ? def : matches[0]

    $(url).click();
}