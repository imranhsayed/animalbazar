(function ( $ ) {
	var cat = {

		/**
		 * The init function.
		 */
		init: function () {
			cat.bindEvents();
			cat.checkPreSelectedCatAndSubCat();
			cat.addHeartIconToParallaxDiv();
			// cat.autoSubmitFormOnFirstPageLoad();
		},

		/**
		 * Defines all Events
		 */
		bindEvents: function() {
			$( '.ad-cat-element' ).on( 'click', cat.triggerCatSelection );
			$( '.ad-subcat-element' ).on( 'click', cat.triggerSubCatSelection );
			$( '.adforest-cat-input-el' ).on( 'click', cat.autoClickSelectCat );
			$( '#category-pop-up-btn .selection' ).on( 'click', cat.popUpCategories );
			$( '.adforest-edit-profile-img' ).on( 'click', cat.clickEditProfileButton );
			$( '#parallax-div-post-ad-btn button' ).on( 'click', cat.autoClickOnPostAdd );
			$( '.Aquarium' ).on( 'click', cat.showPetSpecification );
			$( '.Birds' ).on( 'click', cat.showPetSpecification );
			$( '.ad-wid-cat-heading' ).on( 'click', cat.toggleSubCategories );
			$( '.ad-wid-specif-heading' ).on( 'click', cat.toggleSpecificationSubCategories );
			$( '.ad-widget-locat-heading' ).on( 'click', cat.toggleSpecificationSubCategories );
			$( '.ad-sidebar-search input' ).on( 'click', cat.adSearchWidgetAjax );
		},

		/**
		 * Makes the Categories auto select when user selects the category elements.
		 *
		 * @param event
		 */
		triggerCatSelection: function ( event ) {
			var targetElId = event.target.getAttribute( 'data-pet-id' ),
				parentElement = event.target.parentElement,
				parentElId = parentElement.getAttribute( 'id' ),
				selectorToTargetInputEl = '#' + parentElId + ' input',
				inputTargetEl = document.querySelector( selectorToTargetInputEl ),
				className = '.select-' + targetElId,
				id = 'sub-cat-' + targetElId,
				selectContainer = $( '.anbz-category-list-container' ),
				selectHeadingEl = $( '.adforest-subcategory-select-category' ),
				subCatWrapper = $( '.ad-sub-cat-wrapper' ),
				petSpecifiHeadingLabel = $( '.pet-specification-heading-label' ),
				selectedCatName;

			cat.resetAndToggleCatColor( parentElement );
			cat.realignCatElOnCatSelection();
			$( '.pet-subcategory-js-wrapper' ).removeClass( 'adforest-display' );

			// Selected Cat name
			selectedCatName = event.target.getAttribute( 'data-pet-name' );
			$( '.ad-selected-cat-name' ).text( selectedCatName );
			$('.postdetails .submit-form label .ad-selected-cat-name' ).css( 'color', '#30aeea' );

			// Set the Subcategory placeholder to null on cat selection
			$( '.ad-selected-sub-cat-name' ).text( '' );

			document.getElementById( 'ad_cat_sub_sub_div' ).style.display = 'none';

			subCatContainer = document.getElementById( id );
			$( '.adforest-category-container input' ).attr( 'checked', false );
			$( inputTargetEl ).attr( 'checked', 'checked' );
			$( '.ad-subcat-element input' ).attr( 'checked', false );

			selectHeadingEl.addClass( 'adforest-display' );
			subCatWrapper.removeClass( 'adforest-display' );
			petSpecifiHeadingLabel.removeClass( 'adforest-display' );
			$( '.adforest-subcat-item-container' ).addClass( 'adforest-display' );

			// If Category has subcategory only then show the heading for subcategory.
			if ( $( subCatContainer ).find( 'p' ).hasClass( 'ad-subcat-element' ) ) {
				document.getElementById( id ).classList.remove( 'adforest-display' )
				//Show sub cat.
				subCatContainer.classList.remove( 'adforest-display' );
				// $( subCatContainer ).bPopup();
				$( subCatWrapper ).removeClass( 'adforest-display' );
				$( '.pet-specification-wrapper' ).removeClass( 'adforest-display' );
			} else {
				subCatWrapper.addClass( 'adforest-display' );
				petSpecifiHeadingLabel.addClass( 'adforest-display' );
				// Auto close Category popup on Cat Selection which does not have parent
				$( '.b-close ' ).click();
			}

			selectContainer.find( 'option' ).removeAttr( 'selected' );
			selectContainer.find( className ).attr( 'selected', 'selected' );
			selectContainer.trigger( 'change' );
		},

		/**
		 * Makes the Sub Categories auto select when user selects the sub category elements.
		 */
		triggerSubCatSelection: function ( event ) {
			var targetElId = event.target.getAttribute( 'data-sub-cat-id' ),
				className = '.sub-category-' + targetElId,
				parentElement, parentElId, selectorToTargetInput, inputTargetEl, subCatContainer,
				subcatOptionArray = $( '#ad_cat_sub' ).find( 'option' ),
				selectedSubCatVal;

			// Reset Subcat Style selection
			$( '.subcat-name' ).css({
				'background': 'white',
				'box-shadow': 'none',
				'border-bottom': '2px solid #fff',
				'color':'#777'
			});
			$( '.ad-subcat-element' ).css({
				'background': 'white',
				'box-shadow': 'none',
				'border-bottom': '2px solid #fff',
				'color':'#777'
			});

			// Selected Sub Cat Value
			selectedSubCatVal = event.target.getAttribute( 'data-sub-cat-name' );
			$( '.ad-selected-sub-cat-name' ).text( ' >> ' + selectedSubCatVal );

			// Change Subcat background and color for selection
			if ( 'subcat-name' === event.target.getAttribute( 'class' ) ) {
				event.target.parentElement.style.boxShadow = '3px 3px 3px rgba(93, 93, 93, 0.6)';
				event.target.parentElement.style.borderBottom = '2px solid rgba(93, 93, 93, 0.6)';
			} else {
				event.target.style.boxShadow = '3px 3px 3px rgba(93, 93, 93, 0.6)';
				event.target.style.borderBottom = '2px solid rgba(93, 93, 93, 0.6)';

			}


			for ( var i = 0; i < subcatOptionArray.length; i++ ) {
				if ( targetElId === subcatOptionArray[ i ].value ) {
					subcatOptionArray[ i ].setAttribute( 'selected', 'selected' );
				}
			}
			parentElement = event.target.parentElement;
			if ( 'adforest-subcat-item-container' === parentElement.getAttribute( 'class' ) ) {
				parentElement = event.target;
			}
			parentElId = parentElement.getAttribute( 'id' );
			selectorToTargetInput = '#' + parentElId + ' input';
			inputTargetEl = document.querySelector( selectorToTargetInput );
			subCatContainer = $( '.sub-categories-container' );
			

			subCatContainer.find( className ).attr( 'selected', 'selected' );
			subCatContainer.trigger( 'change' );
			$( '.ad-subcat-element input' ).attr( 'checked', false );
			$( inputTargetEl ).attr( 'checked', 'checked' );

			//Close the Pop up on sub cat selection.
			$( '.pet-category-js-wrapper .cross' ).click();
			$( '.pet-subcategory-js-wrapper' ).addClass( 'adforest-display' );

			// Auto close the Sub Cat window on Cat Selection.
		},

		/**
		 * Reset the categoru background and color
		 *
		 * @param {string} parentElement ParentElement.
		 */
		resetAndToggleCatColor: function ( parentElement ) {
			$( '.adforest-cat-item-container' ).css( {
				'background': 'white',
				'box-shadow': 'none',
				'color': '#777'
			});
			$( '.ad-cat-element' ).css( {
				'color': '#777',
				'box-shadow': 'none',
				'padding': '10px 10px 10px 10px'
			} );
			$( '.ad-cat-wrapper' ).css({
				'float': 'left',
				'margin-top': '10px',
			});
			$( '.cat-name' ).css({
				'padding': '0 100px 0 11px',
				'text-align': 'left'
			});
			// Change the background of the selected element
			parentElement.style.boxShadow = '3px 3px 3px rgba(93, 93, 93, 0.6)';
		},

		realignCatElOnCatSelection: function () {
			$( '.adforest-category-container img' ).addClass( 'adforest-display' );
			$( '.ad-cat-wrapper div' ).css({
				'float': 'none',
				'margin': 0
			});
			$( '.adforest-cat-item-container .ad-cat-element' ).css( 'padding', 0 );
			$( '.ad-cat-element' ).css( 'margin', 0 );
			$( '.adforest-subcat-item-container .b-close' ).css('right', '40px');
		},

		/**
		 * Checks the checkboxes for the category and sub category on a Adds edit page.
		 */
		checkPreSelectedCatAndSubCat: function () {
			var allOptionCatElArray = $( '#ad_cat' ).find( 'option' ),
				allOptionSubCatElArray = $( '#ad_cat_sub' ).find( 'option' );

			for ( var i = 0; i < allOptionCatElArray.length; i++  ) {
				var optionSelectedEl = allOptionCatElArray[ i ];
				if ( optionSelectedEl.hasAttribute( 'selected' ) ) {
					selectedOptionCatId = optionSelectedEl.value;

					$( '#cat-item-' + selectedOptionCatId + ' input' ).attr( 'checked', 'checked' );
					$( '#sub-cat-' + selectedOptionCatId ).removeClass( 'adforest-display' );
					$( '.ad-sub-cat-wrapper' ).removeClass( 'adforest-display' );
					$( '.adforest-subcategory-select-category' ).removeClass( 'adforest-display' );
				}
			}

			for ( var i = 0; i < allOptionSubCatElArray.length; i++  ) {
				var optionSubCatSelectedEl = allOptionSubCatElArray[ i ];
				if ( optionSubCatSelectedEl.hasAttribute( 'selected' ) ) {
					selectedOptionSubCatId = optionSubCatSelectedEl.value;

					$( '#ad-subcat-el-' + selectedOptionSubCatId + ' input' ).attr( 'checked', 'checked' );
				}
			}
		},

		/**
		 * Auto Clicks on Category Select Button
		 * 
		 * @param event
		 */
		autoClickSelectCat: function( event ) {
			var clickedParentEl = event.target.parentElement,
			clickedParentElId = clickedParentEl.getAttribute( 'data-pet-id' ),
			elTextContent = document.getElementById( clickedParentElId ).textContent,
			selectEl = $( '.adforest-subcategory-select-category' );
			selectEl.removeClass( 'adforest-display' );
			event.target.parentElement.click();

			if ( 'Aquarium Fish' === elTextContent || 'Pet Birds' === elTextContent ) {
				$( '.adforest-subcategory-select-category' ).addClass( 'adforest-display' );
				$( '.ad-sub-cat-wrapper' ).addClass( 'adforest-display' );
			}

		},

		/**
		 * Creates a pop up for categories.
		 *
		 * @param event
		 */
		popUpCategories: function ( event ) {
			$('.pet-category-js-wrapper').bPopup();

			$('.ad-sub-cat-wrapper').addClass('adforest-display');
			$('.pet-specification-wrapper').addClass('adforest-display');

			// Reset Cat Items alignment on Cat button click
			$('.adforest-category-container img').removeClass('adforest-display');
			$('.adforest-category-container div').css({
				'float': 'left',
				'margin': '10px'
			});
			$('.cat-name').css({
				'padding': '10px',
				'text-align': 'center'
			});
			$('.adforest-cat-item-container .ad-cat-element').css('padding', '10px');

			// Change the x button position
			$('.b-close').css({
				'right': '12px',
				'top': '6px',
				'color': '#0092B2',
				'padding': '1px 11px 0px 11px'
			});
		},

		/**
		 * On Click on Edit Profile image tab on Profile page, it should click on edit rofile and scroll the window to 1500 px down.
		 */
		clickEditProfileButton: function () {
			$( '.profile_tabs' ).click();
			$( window ).scrollTop( 1500 );
		},

		/**
		 * Adds the heart icon to parallax div on home page
		 */
		addHeartIconToParallaxDiv: function () {
			$( '<i class="flaticon-shapes heart-shapes"></i>' ).insertBefore( '.parallax-div-heading' );
		},

		/**
		 * Auto clicks on Post ADd on click of post a free add button in parallax div on home page.
		 */
		autoClickOnPostAdd: function () {
			document.querySelector( '.menu-list-items .menu-search-bar a' ) .click();
		},

		/**
		 * On click of aquarium fish and pet birds show pet specification div.
		 */
		showPetSpecification: function () {
			$( '.pet-specification-wrapper' ).removeClass( 'adforest-display' );
		},

		/**
		 * On click of categories opens subcategories in Ad Search Widget
		 */
		toggleSubCategories: function () {
			event.preventDefault();
			$( event.target ).next().slideToggle( 'adforest-display' );
		},

		/**
		 * On click of pet specification heading opens sub specification in Ad Search Widget
		 */
		toggleSpecificationSubCategories: function () {
			event.preventDefault();
			$( event.target ).next().slideToggle( 'adforest-display' );
		},

		/**
		 *
		 */
		getAllAdSearchInputEl: function () {
			var allInputEl = document.querySelectorAll( '.ad-sidebar-search input' ),
				elementObj = {
					'ad_cats': [],
					'petage': [],
					'petcolor': [],
					'petgender': [],
					'petsize': [],
					'petquality': [],
					'petweight': [],
					'petisvaccinated': [],
					'petispregnant': [],
					'petbreedpercentage': [],
					'petweightatbirth': [],
					'petteeth': [],
					'petheight': [],
					'petmilkingcapacity': [],
					'ad_country': [],
				},
				checkedEl, checkedElVal, hasAttr;

			if ( allInputEl ) {
				for ( var i = 0; i < allInputEl.length; i++ ) {
					hasAttr = allInputEl[ i ].hasAttribute( 'checked' );
					if ( hasAttr ) {
						checkedEl = allInputEl[ i ];
						checkedElVal = checkedEl.value;
						if ( 'ad_cats' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.ad_cats.push( checkedElVal );
						}
						if ( 'petage' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petage.push( checkedElVal );
						}
						if ( 'petcolor' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petcolor.push( checkedElVal );
						}
						if ( 'petgender' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petgender.push( checkedElVal );
						}
						if ( 'petsize' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petsize.push( checkedElVal );
						}
						if ( 'petquality' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petquality.push( checkedElVal );
						}
						if ( 'petweight' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petweight.push( checkedElVal );
						}
						if ( 'petisvaccinated' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petisvaccinated.push( checkedElVal );
						}
						if ( 'petispregnant' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petispregnant.push( checkedElVal );
						}
						if ( 'petbreedpercentage' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petbreedpercentage.push( checkedElVal );
						}
						if ( 'petweightatbirth' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petweightatbirth.push( checkedElVal );
						}
						if ( 'petteeth' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petteeth.push( checkedElVal );
						}
						if ( 'petheight' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petheight.push( checkedElVal );
						}
						if ( 'petmilkingcapacity' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.petmilkingcapacity.push( checkedElVal );
						}
						if ( 'ad_country' === checkedEl.getAttribute( 'data-taxonomy' ) ) {
							elementObj.ad_country.push( checkedElVal );
						}
					}
				}
			}

			return elementObj;
		},

		/**
		 * Pushes the taxonomy id basis condition
		 * @param taxonomy
		 * @param elementObj
		 * @param checkedEl
		 * @param checkedElVal
		 */
		pushIdToEl: function ( taxonomy, elementObj, checkedEl, checkedElVal ) {
			if ( taxonomy === checkedEl.getAttribute( 'data-taxonomy' ) ) {
				elementObj.ad_cats.push( checkedElVal );
			}
		},

		adSearchWidgetAjax: function ( event ) {

			// Submit the form on click on input checkbox on ad search widget
			document.querySelector( '.ad-search-widget-submit' ).click();
			if ( event.target.hasAttribute( 'checked' ) ) {
				event.target.setAttribute( 'checked', false );
			} else {
				event.target.setAttribute( 'checked', 'check' );
			}

			var elementObj = cat.getAllAdSearchInputEl();
			var request = $.post(
				postdata.ajax_url,   // this url till admin-ajax.php  is given by functions.php wp_localoze_script()
				{
					action: 'my_ajax_hook',
					ad_cats: elementObj.ad_cats,
					petage: elementObj.petage,
					petcolor: elementObj.petcolor,
					petgender: elementObj.petgender,
					petsize: elementObj.petsize,
					petquality: elementObj.petquality,
					petweight: elementObj.petweight,
					petisvaccinated: elementObj.petisvaccinated,
					petispregnant: elementObj.petispregnant,
					petbreedpercentage: elementObj.petbreedpercentage,
					petweightatbirth: elementObj.petweightatbirth,
					petteeth: elementObj.petteeth,
					petheight: elementObj.petheight,
					petmilkingcapacity: elementObj.petmilkingcapacity,
					ad_country: elementObj.ad_country
				},
				function( status ){
					console.log( status );  // result {success: true, data: {…}}data: data_recieved_from_js: {action: "my_ajax_hook", name: "Lawrence", profession: "actress"}hello_world: "hello"__proto__: Objectsuccess: true__proto__: Object
				}
			);

			request.done( function ( response ) {
				console.log( 'The server responded: ');
				console.log( 'my_data: ' + response.data.data_recieved_from_js.my_data); // result mydata: Pass all your data here
				console.log( 'name: ' + response.data.data_recieved_from_js.name );  // result name: Lawrence
				console.log( 'profession: ' + response.data.data_recieved_from_js.profession );  // result  profession: actress
			} );
		},

		autoSubmitFormOnFirstPageLoad: function () {
			var hiddenElHasClass = $( '.hidden-element-to-submit-form' ).hasClass( 'ad-search-hidden-submit' );
			if ( hiddenElHasClass ) {
				$( '.hidden-element-to-submit-form' ).removeClass( 'ad-search-hidden-submit' );
				document.querySelector( '.ad-search-widget-submit' ).click();
			}
		}

	};

	cat.init();


})(jQuery);

