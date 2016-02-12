var ImageView = Backbone.Marionette.ItemView.extend({
    template: '#imageTemplate'
});

var ImageCollectionView = Backbone.Marionette.CollectionView.extend({
    childView: ImageView
});