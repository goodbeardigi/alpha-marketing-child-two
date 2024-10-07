window.bboxInit = function () {
    bbox.showForm('a106b82c-71b8-4245-9dcc-63603dbb1321');
};

(function($){
    const bbScript = document.createElement('script');
    bbScript.src = 'https://bbox.blackbaudhosting.com/webforms/bbox-min.js';
    bbScript.async = true;
    document.getElementsByTagName('head')[0].appendChild(bbScript);

    // Listen for click events on the bbox forms for accordion functionality
    function handleBboxForms() {
        const bboxFormContainer = $('#bbox-root');
        if( bboxFormContainer.length == 0 ) {
            return;
        }
        $(bboxFormContainer).on('click', 'legend', function(e) {
            var closestFormSection = $(this).closest('.BBFormSection');
            if( $(closestFormSection).hasClass('active') ) {
                $(closestFormSection).removeClass('active');
            } else {
                $(closestFormSection).addClass('active');
            }
        });
    }

    // Custom donation form functionality
    function handleCustomDonateForm() {
        const customDonateForm = $('#donation-form');
        if( customDonateForm.length == 0 ) {
            return;
        }

        // Create defaults
        const donationObject = {
            'frequency': 'one off',
            'amount': '25'
        };
        const donationAmountInput = $('#donation-amount');
        const inputContainer      = $('.donate-form__group-container');
        const frequencyField      = $('#donate-frequency');

        // Handle form clicks
        $(customDonateForm).on('click', '.donate-form__list-item', function(e) {
            if( e.target.classList.contains('selected') ) {
                $(this).removeClass('selected');
            } else {
                $(this).siblings().each(function() {
                    $(this).removeClass('selected');
                });
                $(this).addClass('selected');
            }
            // Save donation amount
            if( e.target.classList.contains('amount') ) {
                donationObject.amount = this.dataset.amount;
            }
            // Save frequency
            if( e.target.classList.contains('frequency') ) {
                donationObject.frequency = this.dataset.frequency;
                $(frequencyField).val(donationObject.frequency);
                if( this.dataset.frequency == 'monthly' ) {
                    $(inputContainer).addClass('monthly');
                } else {
                    $(inputContainer).removeClass('monthly');
                }
            }
            $(donationAmountInput).val(donationObject.amount);
        });

        // Handle custom donation amount
        $(donationAmountInput).on('keyup', function(e) {
            donationObject.amount = e.target.value;
            $('.donate-form__list-item.amount').each(function() {
                $(this).removeClass('selected');
                // Check for matching pre-set values
                if( this.dataset.amount == e.target.value ) {
                    $(this).addClass('selected');
                }
            });
        });

        // Handle form submission
        $(customDonateForm).on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serializeArray().map( input => {
                return [input.name, input.value];
            });

            // Build URL parameter
            let urlParam = '';
            formData.map( ( param, index ) => {
                const string = param.join('=');
                urlParam += ( index === 0 ? '?' : '&' ) + encodeURI(string);
            });

            // Navigate to action URL with URL param appended
            window.location.href = customDonateForm[0].action + urlParam;            
        });
    }
    handleCustomDonateForm();
    handleBboxForms();

    
}(jQuery)); 
