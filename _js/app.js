var pageClasses = ["IntroPage", "Step1TravelStylesPage", "Step2InterestsPage", "Step3LocationsPage", "WrapUpPage"];

$(document).ready(function(){

    //page specific initialisers
    switch(getUrlVars().p){
        case "home":
        case "step1":
        case "step2":
        case "step3":
        case "wrapUp":
            initTravelFiltersPage();
            break;
        case "result":
            //initTakeover();
            break;
    }

});

/* ---- Horizontal TravelFiltersPage Initializer ---------------------------------------------- */

function initTravelFiltersPage(){

    // add pagination event handlers
    $(".backButton").on("click", {direction: -1}, scrollToPage);
    $(".nextButton").on("click", {direction: 1}, scrollToPage);

    // actually go to page
    gotoPage(pageIndex);

    /* --- Step 1: Travel Styles ----------------------------------- */

    $(".travelstyleInfo").on("click", function(e){
        
        var $travelStyle = findParent(e.target, ".travelstyleTile");
        $travelStyle.toggleClass("checked");

        var $chk = $travelStyle.find(".chk");
        $chk.prop("checked", !$chk.prop("checked"));

        validateCheckedUserInput("#Step1TravelStylesPage", 1, 7);

    });

    /* --- Step 2: Travel Interests -------------------------------- */

    var stack = gajus.Swing.Stack();

    [].forEach.call(document.querySelectorAll('.stack li'), function (targetElement) {
        stack.createCard(targetElement);

        targetElement.classList.add('in-deck');
    });

    stack.on('throwout', function (e) {
        var $chk = $(e.target).find(".chk");

        if(e.throwDirection < 0){
            e.target.classList.add('interested');
            $chk.prop("checked", true);
        }else{
            e.target.classList.add('uninterested');
            $chk.prop("checked", false);
        }

        validateCheckedUserInput("#Step2InterestsPage", 4, 16);

        e.target.classList.remove('in-deck');
    });

    stack.on('throwin', function (e) {
        var $chk = $(e.target).find(".chk");
        $chk.prop("checked", false);

        validateCheckedUserInput("#Step2InterestsPage", 4, 16);

        e.target.classList.remove('interested');
        e.target.classList.remove('uninterested');
        e.target.classList.add('in-deck');
    });

    /* --- Step 3: Locale Preferences -------------------------------- */

    var $localeTiles = $('.locales');
    $localeTiles.imagesLoaded(function(){
        $localeTiles.masonry({
            itemSelector : '.localeTile',
            columnwidth : 220
        });
        $localeTiles.removeClass("hidden");
    });

    $(".localeTile").on("click", function(e){
        
        var $localeTile = findParent(e.target, ".localeTile");
        $localeTile.toggleClass("checked");

        var $chk = $localeTile.find(".chk");
        $chk.prop("checked", !$chk.prop("checked"));

        validateCheckedUserInput("#Step3LocationsPage", 3, 18);

    });

}

/* ---- Page Handling ---------------------------------------------------------------- */

function scrollToPage(evt){

    var direction = evt.data.direction;

    //prevent going outside pageClasses bounds
    if(
        (direction < 0 && pageIndex < 1) || 
        (direction > 0 && pageIndex > pageClasses.length-2)
    ){
        direction = 0;
    }

    pageIndex += direction;

    gotoPage(pageIndex);

}

function gotoPage(pageIndex){

    $("#pages").removeClass();
    $("#pages").addClass(pageClasses[pageIndex]);

    pageActions(pageClasses[pageIndex]);

}

function pageActions(page){

    // add pagination functionality
    $("#NextButton").addClass("nextButton");
    $("#BackButton").addClass("backButton");

    var stateObj = { page: "p" };
    switch(page){

        // add page animation for Bloodborne Page 1
        case "IntroPage":
            $("#BackButton").removeClass("backButton");
            $("#content").addClass("noScroll");
            history.pushState(stateObj, "home", "?p=home");
        break;

        // add page animation for Step1
        case "Step1TravelStylesPage":
            $("#content").addClass("noScroll");
            history.pushState(stateObj, "step1", "?p=step1");
        break;

        // add page animation for Step2
        case "Step2InterestsPage":
            $("#content").addClass("noScroll");
            history.pushState(stateObj, "step2", "?p=step2");
        break;

        // add page animation for Step3
        case "Step3InterestsPage":
            $("#NextButton").removeClass("nextButton");
            $("#content").addClass("scrollable");
            history.pushState(stateObj, "step3", "?p=step3");
        break;

    }

}

/* ---- Other ---------------------------------------------------------------- */

function validateCheckedUserInput(stepID, minChecked, maxChecked){

    var numChecked = $(stepID).find(".chk:checked").length;

    if(numChecked < minChecked || numChecked >= maxChecked){

        $(stepID).find(".submitSection").addClass("hidden");
        
    }else{

        $(stepID).find(".submitSection").removeClass("hidden");

        if(numChecked > maxChecked && pageIndex != 3){
            $("#Step3LocationsPage").find(".submitSection").removeClass("hidden");
        }

    }

}

function findParent(elem, parentClass){

    var $el = $(elem);
    while($el.is(parentClass) === false){
        $el = $el.parent();
    }
    return $el;

}

function getUrlVars(){

    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++){
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;

}
