var PaginationView = Backbone.Marionette.ItemView.extend({
    events: {
        "click .pagination li a": function(e){
            var href = $(e.currentTarget).attr('href');
            var regExp = /ajax\/album\/([0-9]+?)\/pagination\/([0-9]+?)/;
            var res = regExp.exec(href);

            if (res[1] !== undefined && res[2] !== undefined) {
                ImageApp.Router.navigate('album/' + res[1] + '/page/' + res[2], {trigger:true});
            }


            e.preventDefault();
        }
    }
});

