<script src="<?php echo $cfg['WM']['Server']?>/devices/desktop/sheba/bootstrap/custom_ui_combobox/1.12.1_jquery-ui.js"></script>
<style type="text/css">
    .genFormMultipleTitle, .genFormTextText{
        clear: both;
    }
    .ui-autocomplete{
        max-height: 200px;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    .custom-combobox{
        position: relative;
    }
    .custom-combobox-input{
        display: block;
        float: right;
        width: calc(100% - 52px);
        max-width: calc(340px - 52px);
        padding: 6px 12px;
        line-height: 1.42857143;
        height: 50px;
        border: 1px solid #d2d2d2;
        font-size: 18px;
        margin-bottom: 14px;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        background: #fff;
        
    }
    .custom-combobox-toggle{
        width: 50px;
        float: right;
        background: #fff;
        height: 50px;
         -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .ui-button .ui-icon{
        background-image: url(<?php echo $cfg['WM']['Server']?>/devices/desktop/sheba/bootstrap/custom_ui_combobox/ui-icons_777777_256x240.png);
    }
    .ui-state-hover .ui-icon, .ui-state-focus .ui-icon, .ui-button:hover .ui-icon, .ui-button:focus .ui-icon{
        background-image: url(<?php echo $cfg['WM']['Server']?>/devices/desktop/sheba/bootstrap/custom_ui_combobox/ui-icons_777777_256x240.png);
    }
</style>

<script>
  $( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .attr( "placeholder", $(this.element).find('option:first-child').html() )
          .addClass( "custom-combobox-input ui-widget  form-control ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
          if (this.element[0].dataset.required){
            $(this.input).prop('required',true);
          }
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          /*
          .tooltip()
          */
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          /*
          .tooltip( "open" );
          */
        this.element.val( "" );
        /*
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        */
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  } );
</script>