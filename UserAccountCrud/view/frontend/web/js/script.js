require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function(
        $,
        modal
    ) {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            buttons: [{
                text: $.mage.__('Submit'),
                class: 'mymodal'
            }]
        };

        var popup = modal(options, $('#popup-modal'));
            $("#click-me").on('click',function(){
                $("#popup-modal").modal("openModal");
            });
        
    }
    );