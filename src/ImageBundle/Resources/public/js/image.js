
var ImageApp = Backbone.Marionette.Application.extend({});

var ImageApp = new ImageApp();

ImageApp.on('before:start', function(){
    var RegionContainer = Marionette.LayoutView.extend({
        el: '#image-app-container',
        regions: {
            album: '#album',
            pagination: '.pagination'
        }
    });

    ImageApp.regions = new RegionContainer();
});

ImageApp.on('start', function(){
    Backbone.history.start();
});

$(function(){
    ImageApp.Router = new AlbumRouter({
        controller: AlbumController
    });

    ImageApp.start();
});