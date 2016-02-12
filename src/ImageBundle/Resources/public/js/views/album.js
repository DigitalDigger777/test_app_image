var AlbumView = Backbone.Marionette.ItemView.extend({
    template: '#albumTemplate'
});

var AlbumCollectionView = Backbone.Marionette.CollectionView.extend({
    childView: AlbumView
});