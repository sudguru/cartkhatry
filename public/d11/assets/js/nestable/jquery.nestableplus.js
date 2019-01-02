/*jslint browser: true, devel: true, white: true, eqeq: true, plusplus: true, sloppy: true, vars: true*/
/*global $ */

/*************** General ***************/

var updateOutput = function(e) {
    var list = e.length ? e : $(e.target),
        output = list.data('output');
    if (window.JSON) {
        if (output) {
            output.val(window.JSON.stringify(list.nestable('serialize')));
        }
    } else {
        alert('JSON browser support required for this page.');
    }
    $('#changespending').html("Your changes have not been saved yet.")
    $('#changespending').show();
};

var nestableList = $("#nestable > .dd-list");

/***************************************/
var menuAdd = $("#menu-add"); //sudeep
var menuEditor = $("#menu-editor");

/*************** Delete ***************/

var deleteFromMenuHelper = function(target) {
    if (target.data('new') == 1) {
        // if it's not yet saved in the database, just remove it from DOM
        target.fadeOut(function() {
            target.remove();
            updateOutput($('#nestable').data('output', $('#json-output')));
        });
    } else {
        // otherwise hide and mark it for deletion
        target.appendTo(nestableList); // if children, move to the top level
        target.data('deleted', '1');
        target.fadeOut();
    }
};

var deleteFromMenu = function() {
    var targetId = $(this).data('owner-id');
    var target = $('[data-id="' + targetId + '"]');

    var result = confirm("Delete " + target.data('name') + " and all its subitems ?");
    if (!result) {
        return;
    }

    // Remove children (if any)
    target.find("li").each(function() {
        deleteFromMenuHelper($(this));
    });

    // Remove parent
    deleteFromMenuHelper(target);

    menuEditor.hide();
    menuAdd.show(); //sudeep
    // update JSON
    updateOutput($('#nestable').data('output', $('#json-output')));
};

/***************************************/


/*************** Edit ***************/

var menuEditor = $("#menu-editor");
var editButton = $("#editButton");
var editInputName = $("#editInputName");
var currentEditName = $("#currentEditName");

// Prepares and shows the Edit Form
var prepareEdit = function() {
    var targetId = $(this).data('owner-id');
    var target = $('[data-id="' + targetId + '"]');

    editInputName.val(target.data("name"));
    currentEditName.html(target.data("name"));
    editButton.data("owner-id", target.data("id"));

    console.log("[INFO] Editing Menu Item " + editButton.data("owner-id"));
    menuAdd.hide(); //sudeep
    menuEditor.fadeIn();
};

// Edits the Menu item and hides the Edit Form
var editMenuItem = function() {
    var targetId = $(this).data('owner-id');
    var target = $('[data-id="' + targetId + '"]');

    var newName = editInputName.val();

    target.data("name", newName);

    target.find("> .dd-handle").html(newName);

    menuEditor.fadeOut();
    menuAdd.show(); //sudeep
    // update JSON
    updateOutput($('#nestable').data('output', $('#json-output')));

    document.getElementById("addInputName").value = "";

};

/***************************************/


/*************** Add ***************/

var newIdCount = 1;

var addToMenu = function() {
    var newName = $("#addInputName").val();
    var newId = 'new-' + newIdCount;

    nestableList.append(
        '<li class="dd-item dd3-item" ' +
        'data-id="' + newId + '" ' +
        'data-name="' + newName + '" ' +
        'data-new="1" ' +
        'data-deleted="0">' +
        '<div class="dd-handle dd3-handle"></div><div class="dd3-content"><a href="#">' + newName + '</a> ' +
        '<span class="button-delete btn btn-default btn-xs pull-right" ' +
        'data-owner-id="' + newId + '"> ' +
        '<i class="fa fa-times-circle-o" aria-hidden="true"></i> ' +
        '</span>' +
        '<span class="button-edit btn btn-default btn-xs pull-right" ' +
        'data-owner-id="' + newId + '">' +
        '<i class="fa fa-pencil" aria-hidden="true"></i>' +
        '</span>' +
        '</div></li>'
    );

    newIdCount++;

    // update JSON
    updateOutput($('#nestable').data('output', $('#json-output')));

    //empty input values
    document.getElementById("addInputName").value = "";

    // set events
    $("#nestable .button-delete").on("click", deleteFromMenu);
    $("#nestable .button-edit").on("click", prepareEdit);
};



/***************************************/



$(function() {
    $('#nestable').nestable({
            maxDepth: 3
    }).on('change', updateOutput);
    $('.dd').nestable('collapseAll');
    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#json-output')));

    // set onclick events
    editButton.on("click", editMenuItem);

    $("#nestable .button-delete").on("click", deleteFromMenu);

    $("#nestable .button-edit").on("click", prepareEdit);

    $("#menu-editor").submit(function(e) {
        e.preventDefault();
    });

    $("#menu-add").submit(function(e) {
        e.preventDefault();
        addToMenu();
    });
    
    

});
