$(function(){
    const zone = $('#show')[0];
    const sort = new Sortable(zone,{
        animation: 144,
        draggable: ".dz-preview",
        filter: "#add-img",
        preventOnFilter: true,
    });
})
