
// function makeRadiosDeselectableByName(){
//     $('input[name="sim_id"]').on('click', function() {
//         const $this = $(this);

//         if($this.prop('checked') == true){
//             $this.prop('checked', false);
//         } else {
//             $this.prop('checked', true);
//         }

//     });
// };


function showPortingInput(event, $modalId) {

    if ($modalId == 'editPlan') {
        var $portSection = $('#editPlan').find('section.edit-sim-section').find('section.edit-port-section');
    } else {
        var $portSection = $('#choosePlan').find('section.port-section');
    }

    const $portNumber = $portSection.find('.port-number'),
          $areaCode   = $portSection.find('.area-code'),
          $prevDiv    = $portNumber.prev('div');

    if ($(event.target).is(":checked")) {

        $prevDiv.removeClass('d-none');
        $portNumber.removeClass('d-none');

        // $areaCode.find('input[name="area_code"]').val('');
        $areaCode.addClass('d-none');
    }
};

function hidePortingInput(event, $modalId) {

    if ($modalId == 'editPlan') {
        var $portSection = $('#editPlan').find('section.edit-sim-section').find('section.edit-port-section');
    } else {
        var $portSection = $('#choosePlan').find('section.port-section');
    }

    const $portNumber = $portSection.find('.port-number'),
          $areaCode   = $portSection.find('.area-code'),
          $prevDiv    = $portNumber.prev('div');

    if ($(event.target).is(":checked")) {


        // $portNumber.find('input[name="port_number"]').val('');
        $prevDiv.addClass('d-none');
        $portNumber.addClass('d-none');


        $areaCode.removeClass('d-none');

    }
};
function showSimInput(event, $modalId) {

    if ($modalId == 'editPlan') {
        var $simSection      = $('#editPlan').find('section.edit-sim-section');
        var $portSection     = $('section.edit-port-section');
        var $areaCodeSection = $simSection.find('section.edit-area-code-section');

    } else {
        var $simSection      = $('#choosePlan').find('section.sim-section');
        var $portSection     = $('section.port-section');
        var $areaCodeSection = $simSection.find('section.area-code-section');
    }


    const $formGroup       = $simSection.find('.form-group'),
          $parentDiv       = $formGroup.parent('div');

    if ($(event.target).is(":checked")) {

        $parentDiv.removeClass('d-none');
        $parentDiv.prev('div').removeClass('d-none');
    }
};

function hideSimInput(event, $modalId) {

    if ($modalId == 'editPlan') {
        var $simSection      = $('#editPlan').find('section.edit-sim-section');
        var $portSection     = $simSection.find('section.edit-port-section');
        var $areaCodeSection = $simSection.find('section.edit-area-code-section');
    } else {
        var $simSection      = $('#choosePlan').find('section.sim-section');
        var $portSection     = $('section.port-section');
        var $areaCodeSection = $simSection.find('section.area-code-section');
    }


    const $formGroup       = $simSection.find('.form-group'),
          $parentDiv       = $formGroup.parent('div');

    if ($(event.target).is(":checked")) {

        $parentDiv.addClass('d-none');
        $parentDiv.prev('div').addClass('d-none');

    }
};


// function showSimInputs(event, $modalId) {

//     if ($modalId == 'editPlan') {
//         var $simSection      = $('#editPlan').find('section.edit-sim-section');
//         var $portSection     = $('section.edit-port-section');
//         var $areaCodeSection = $simSection.find('section.edit-area-code-section');

//     } else {
//         var $simSection      = $('#choosePlan').find('section.sim-section');
//         var $portSection     = $('section.port-section');
//         var $areaCodeSection = $simSection.find('section.area-code-section');
//     }


//     const $formGroup       = $simSection.find('.form-group'),
//           $parentDiv       = $formGroup.parent('div');

//     if ($(event.target).is(":checked")) {

//         $parentDiv.removeClass('d-none');
//         $parentDiv.prev('div').removeClass('d-none');

//         $portSection.removeClass('d-none');
//         $areaCodeSection.removeClass('d-none');

//         $portSection.find('.port-number').addClass('d-none');
//         $portSection.find('.port-number').prev('div').addClass('d-none');


//     }
// };

// function hideSimInputs(event, $modalId) {

//     if ($modalId == 'editPlan') {
//         var $simSection      = $('#editPlan').find('section.edit-sim-section');
//         var $portSection     = $simSection.find('section.edit-port-section');
//         var $areaCodeSection = $simSection.find('section.edit-area-code-section');
//     } else {
//         var $simSection      = $('#choosePlan').find('section.sim-section');
//         var $portSection     = $('section.port-section');
//         var $areaCodeSection = $simSection.find('section.area-code-section');
//     }


//     const $formGroup       = $simSection.find('.form-group'),
//           $parentDiv       = $formGroup.parent('div');

//     if ($(event.target).is(":checked")) {

//         $parentDiv.addClass('d-none');
//         $parentDiv.prev('div').addClass('d-none');

//         $portSection.addClass('d-none');
//         $areaCodeSection.addClass('d-none');

//     }
// };
