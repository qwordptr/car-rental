
function loadConversation() {
    $('[data-toggle="last-message"]').on("click",function(e) {
        e.preventDefault();
        var $this = $(this),
            loadurl = $this.attr('href'),
            targ = $this.attr('data-target');

        console.log(loadurl)

        $.get(loadurl, function(data) {
            $(targ).html(data).appendTo(targ);

            $this.tab('show');
        });
    });
}



