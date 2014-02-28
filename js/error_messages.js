function errorMsg(returnId, key, lang)
{
	var defineArr = 
				{
					TAX_VALIDATE_MSG: 
								{
									EN: 'Please enter the required fields.', 
									SP: 'Por favor, introduzca los campos requeridos.'
								},
					TAX_LOGGINGVEHI_MSG: 
								{
									EN: 'Please select whether Logging vehicle or not ?', 
									SP: 'Por favor, seleccione si el registro del vehículo o no?'
								},
					TAX_VEHIINFO_MSG:
								{
									EN: 'Please select atleast one vehicle type.',
									SP: 'Por favor, seleccione al menos un tipo de vehículo.'
								},
					TAX_FILEFORM_MSG:
								{
									EN: 'Please choose a form to file.',
									SP: 'Por favor, introduzca los campos requeridos.'
								},
					TAX_PASSWORD_LENGTH: 
								{
									EN: 'Password should contain at least 6 letters or numbers.', 
									SP: 'Password should contain at least 6 letters or numbers.'
								},
					REENTER_PASSWORD: 
								{
									EN: 'Re- enter the password. Password and Confirm Password must be the same.', 
									SP: 'This is a required field. Re- enter the password. Password and Confirm Password must be the same.'
								},
					TAX_MISMATCH_PASSWORD: 
								{
									EN: 'Password and Confirm Password must be the same', 
									SP: 'Password and Confirm Password must be the same'
								},
					TAX_MISMATCH_EMAIL: 
								{
									EN: 'E- Mail and Confirm E- Mail must be the same.', 
									SP: 'E-Mail y Confirmar E-mail debe ser la misma.'
								},
					REENTER_EMAIL: 
								{
									EN: 'Re- enter the E- Mail. E- Mail and Confirm E- Mail must be the same.', 
									SP: 'This is a required field. Re- enter the E- Mail. E- Mail and Confirm E- Mail must be the same.'
								},
					ENTER_PHONE: 
								{
									EN: 'Enter the Phone Number.', 
									SP: 'This is a required field. Enter the Phone Number.'
								},
					TAX_PHONE_VALID: 
								{
									EN: 'Please Enter a valid phone ( eg: (111)-111-1111 ).',
									SP: 'Por favor ingrese un número de teléfono válido.'
								},
					TAX_BIZ_NAME: 
								{
									EN: 'Enter valid name.',
									SP: 'Enter valid name.'
								},
					TAX_BIZ_CITY: 
								{
									EN: 'Enter valid city.',
									SP: 'Enter valid city.'
								},
					TAX_TERM_CONTIDION: 
								{
									EN: 'Please accept terms & conditions.', 
									SP: 'Por favor, acepte los términos y condiciones.'
								},
					TAX_EMAIL_INVALID: 
								{
									EN: 'Enter a valid Email.', 
									SP: 'Dirección de correo electrónico válida.'
								},		
					TAX_PASSWORD_INVALID: 
								{
									EN: 'Password should contain at least 6 letters or numbers.', 
									SP: 'Password should contain at least 6 letters or numbers.'
								},
					TAX_ZIP_VALID:
								{
									EN: 'Enter a valid zipcode.', 
									SP: 'Introduzca  un código postal válido.'
								},
					TAX_SELECT_STATE:
								{
									EN: 'Please select any state.',
									SP: 'Por favor, seleccione cualquier estado.'
								},
					TAX_VIN_INVALID:
								{
									EN: 'Please enter a 17 digit VIN number',
									SP: 'Por favor ingrese un número de VIN válido'
								},
					PRE_CAT_INVALID:
								{
									EN: 'Please select previous category',
									SP: 'Please select previous category'
								},
					CHN_CAT_INVALID:
								{
									EN: 'Please select changed category',
									SP: 'Please select changed category'
								},
					CHN_MON_INVALID:
								{
									EN: 'Please select changed month',
									SP: 'Please select changing category'
								},
					REQUIRE_MSG:
								{
									EN: 'This is a required field.',
									SP: 'This is a required field.'
								},
					FIRSTNAME_ERROR:
								{
									EN: 'Enter the First Name.',
									SP: 'This is a required field. Enter the First Name.'
								},
					LASTNAME_ERROR:
								{
									EN: 'Enter the Last Name.',
									SP: 'This is a required field. Enter the Last Name.'
								},
					ENTEREMAIL_ERROR:
								{
									EN: 'Enter the Email Address in the format xx@xxx.xxx.',
									SP: 'This is a required field. Enter the Email Address in the format xx@xxx.xxx.'
								},
					EMAILFORMAT_ERROR:
								{
									EN: 'Enter the Email Address in the format xx@xxx.xxx.',
									SP: 'Enter the Email Address in the format xx@xxx.xxx.'
								},
					CAPTCHA_ERROR:
								{
									EN: 'Type the letters you see in the picture.',
									SP: 'This is a required field. Type the letters you see in the picture.'
								},
					WRONG_CAPTCHA_ERROR:
								{
									EN: 'Verification code not matching.',
									SP: 'Verification code not matching.'
								},
					COUNTRYCODE_ERROR:
								{
									EN: 'Enter the country code.',
									SP: 'This is a required field. Enter the country code.'
								},
					TGW_CHG_CAT_GRATER_INVALID:
								{
									EN: 'Changed Category must be greater than Previous Category.',
									SP: 'Changed Category must be greater than Previous Category.'
								},
					ENTERVIN:
								{
									EN: 'Enter the Vehicle Identification Number.',
									SP: 'This is a required field. Enter the Vehicle Identification Number.'
								},
					ENTER_VALID_VIN:
								{
									EN: 'Enter a valid Vehicle Identification Number.',
									SP: 'Enter a valid Vehicle Identification Number.'
								},
					ENTER_TAX_GROSWT:
								{
									EN: 'This is a required entry. Select the taxable gross weight.',
									SP: 'This is a required entry. Select the taxable gross weight.'
								},
					SELECT_LOSS_TYPE:
								{
									EN: 'This is a required entry. Select the type of loss.',
									SP: 'This is a required entry. Select the type of loss.'
								},
					SELECT_FIRST_USED_MONTH:
								{
									EN: 'This is a required entry. Select the tax year reported when the tax was paid for this vehicle.',
									SP: 'This is a required entry. Select the tax year reported when the tax was paid for this vehicle.'
								},
					SELECT_STOLEN_DESTROY_DATE:
								{
									EN: 'This is a required entry. Select the date on which the vehicle was either sold, destroyed or stolen.',
									SP: 'This is a required entry. Select the date on which the vehicle was either sold, destroyed or stolen.'
								},
					FIRST_MONTH_NOT_SAMEYEAR:
								{
									EN: 'The First used month when the return was filed for the vehicle previously cannot be greater than the current date.',
									SP: 'The First used month when the return was filed for the vehicle previously cannot be greater than the current date.'
								},
					FIRST_MONTH_PAST_DATE:
								{
									EN: 'Refund can be claimed on a vehicle that was used 5,000 miles or less( 7,500 miles or less for agricultural vehicle)only on the first form 2290 filed for the next period. The first used month when the return was filed for the vehicle should always in the prior tax year.',
									SP: 'Refund can be claimed on a vehicle that was used 5,000 miles or less( 7,500 miles or less for agricultural vehicle)only on the first form 2290 filed for the next period. The first used month when the return was filed for the vehicle should always in the prior tax year.'
								},
					SOLD_DESTROYED_NOT_SAMEYEAR:
								{
									EN: 'A vehicle cannot be sold/ destroyed or stolen in a future date. Enter the date when the vehicle was damaged by accident, sold or stolen and it is not economical to rebuild.',
									SP: 'A vehicle cannot be sold/ destroyed or stolen in a future date. Enter the date when the vehicle was damaged by accident, sold or stolen and it is not economical to rebuild.'
								},
					SOLDDESTROYED_GREATERTHAN_FIRSTUSED:
								{
									EN: 'The date when the vehicle was sold/ destroyed or stolen should always be greater than the first used month when the return was filed for the vehicle previously.',
									SP: 'The date when the vehicle was sold/ destroyed or stolen should always be greater than the first used month when the return was filed for the vehicle previously.'
								},
					SOLDDESTROYED_LESSTHAN_FIRSTUSED:
								{
									EN: 'Sold / Destroyed date must be less than first used year.',
									SP: 'Sold / Destroyed date must be less than first used year.'
								},
					SOLDDESTROYED_WITHIN_TAXYEAR:
								{
									EN: 'Sold / Destroyed date has to be within the same tax period.',
									SP: 'Sold / Destroyed date has to be within the same tax period.'
								},
					SOLDDESTROYED_WITHIN_THREE_TAXYEAR:
								{
									EN: 'We support filing the credits for sold/ destroyed or stolen vehicles in form 2290 only for the previous 3(three) years.',
									SP: 'We support filing the credits for sold/ destroyed or stolen vehicles in form 2290 only for the previous 3(three) years.'
								},
					UPLOAD_FILE_TYPES:
								{
									EN: 'Please upload only pdf files.',
									SP: 'Please upload only pdf files.'
								},
					UPLOAD_SIZE_EXCEEDED:
								{
									EN: 'You can upload only a maximum of 2MB.',
									SP: 'You can upload only a maximum of 2MB.'
								},
					NO_TAXABLE_VEHICLE_FOUND:
								{
									EN: 'No taxable vehicles found in the filing. Please add taxable vehicle first.',
									SP: 'No taxable vehicles found in the filing. Please add taxable vehicle first.'
								},
					ENTER_SOLD_EXPLANATION:
								{
									EN: 'Enter a detailed description, explaining the facts for the credits claimed.',
									SP: 'Enter a detailed description, explaining the facts for the credits claimed.'
								},			
					SELECT_LORNOT:
								{
									EN: 'Select whether Logging vehicle or not.',
									SP: 'Select whether Logging vehicle or not.'
								},
					ENTER_BANKNAME:
								{
									EN: 'Enter the Bank Name.',
									SP: 'This is a required field. Enter the Bank Name.'
								},
					SELECT_ACCTYPE:
								{
									EN: 'Select Account Type.',
									SP: 'This is a required field. Select Account Type.'
								},
					ENTER_ACCNO:
								{
									EN: 'Enter the Bank Account Number.',
									SP: 'This is a required field. Enter the Bank Account Number.'
								},
					ENTER_ROUTINGNO:
								{
									EN: 'Enter the Routing Transit Number.',
									SP: 'This is a required field. Enter the Routing Transit Number.'
								},
					ACCEPTTERMS:
								{
									EN: 'Please accept terms & conditions.',
									SP: 'Please accept terms & conditions.'
								},
					SELECT_PAYMODE:
								{
									EN: 'Please select any one of the payment options provided and accept the conditions to proceed!.',
									SP: 'Please select any one of the payment options provided and accept the conditions to proceed!.'
								},
					ENTER_EMAIL:
								{
									EN: 'Enter the Email Address.',
									SP: 'Enter the Email Address.'
								},
					ENTER_BIZNAME:
								{
									EN: 'Enter the Business Name.',
									SP: 'This is a required field.Enter the Business Name.'
								},
					SELECT_BIZTYPE:
								{
									EN: 'Select a Business Type.',
									SP: 'This is a required field. Select a Business Type.'
								},
					ENTER_EIN:
								{
									EN: 'Enter the EIN.',
									SP: 'This is a required field.Enter the EIN.'
								},
					ENTER_ADDRESS:
								{
									EN: 'This is a required entry. Enter the business address.',
									SP: 'This is a required entry. Enter the business address.'
								},
					SELECT_COUNTRY:
								{
									EN: 'Select a Country.',
									SP: 'This is a required field. Select a Country.'
								},
					SELECT_STATE:
								{
									EN: 'Select a State.',
									SP: 'This is a required field. Select a State.'
								},
					ENTER_CITY:
								{
									EN: 'Enter the City or Town.',
									SP: 'This is a required field.Enter the City or Town.'
								},
					ENTER_ZIP:
								{
									EN: 'Enter the Zipcode of your business.',
									SP: 'This is a required field.Enter the Zipcode of your business.'
								},
					ENTER_VALID_ZIP:
								{
									EN: 'Enter a valid Zipcode.',
									SP: 'Enter a valid Zipcode.'
								},
					ENTER_PHONE_NUMBER:
								{
									EN: 'Enter the Phone Number.',
									SP: 'This is a required field.Enter the Phone Number'
								},
					ENTER_SA_NAME:
								{
									EN: 'Enter the Signing Authority Name.',
									SP: 'This is a required field.Enter the Signing Authority Name'
								},
					ENTER_SA_TITLE:
								{
									EN: 'Enter the Signing Authority"s Title.',
									SP: 'This is a required field.Enter the Signing Authority"s Title'
								},
					ENTER_SA_PHONE:
								{
									EN: 'Enter the phone number of the Signing Authority',
									SP: 'This is a required field.Enter the phone number of the Signing Authority'
								},
					ENTER_SA_PIN:
								{
									EN: 'Enter the signing authority pin',
									SP: 'This is a required field.Enter the signing authority pin'
								},
				    ENTER_DES_NAME:
								{
									EN: 'This is a required field as you would like to discuss your returns with a third party. Enter the Third party designee"s Name',
									SP: 'This is a required field as you would like to discuss your returns with a third party. Enter the Third party designee"s Name'
								},
					ENTER_DES_PHONE:
									{
										EN: 'This is a required entry. Enter the Designee’s phone number',
										SP: 'This is a required entry. Enter the Designee’s phone number'
									},
					ENTER_VALID_DES_PHONE:
									{
										EN: 'Enter a Valid Designee’s phone number',
										SP: 'Enter a Valid Designee’s phone number'
									},
					ENTER_DES_PIN:
									{
										EN: 'This is a required entry. Enter the Designee’s PIN',
										SP: 'This is a required entry. Enter the Designee’s PIN'
									},
					ENTEREMAIL_ERROR:
									{
										EN: 'Enter a valid Email Address in the format xx@xxx.xxx.',
										SP: 'Enter a valid Email Address in the format xx@xxx.xxx.'
									},
					SOLD_TRANSFER_TO:
									{
										EN: 'Please enter name of whom to sold / transfered',
										SP: 'Please enter name of whom to sold / transfered'
									},
					SELECT_SUSPENSION:
									{
										EN: 'Please select anyone of the suspension',
										SP: 'Please select anyone of the suspension'
									},
					SELECT_DATE:
									{
										EN: 'Please select date',
										SP: 'Please select date'
									},
					CLAIM_AMOUNT:
									{
										EN: 'Please enter the amount of claim',
										SP: 'Please enter the amount of claim'
									},
					CLAIM_AMOUNT_NOT_ZERO:
									{
										EN: 'Amount of claim should not be 0',
										SP: 'Amount of claim should not be 0'
									},
					OVER_PAY_EXPLAIN:
									{
										EN: 'Enter a detailed description about credit claim',
										SP: 'Enter a detailed description about credit claim'
									},
					PAST_DATE:
									{
										EN: 'Date of tax payment should be a past date.',
										SP: 'Date of tax payment should be a past date.'
									},
					OWNER_FIRST_NAME:
									{
										EN: 'This is a required entry. Enter the Owner First Name.',
										SP: 'This is a required entry. Enter the Owner First Name.'
									},
					OWNER_LAST_NAME:
									{
										EN: 'This is a required entry. Enter the Owner Last Name.',
										SP: 'This is a required entry. Enter the Owner Last Name.'
									},
					ERROR_SELECT_BIZ:
									{
										EN: 'Please select a business',
										SP: 'Please select a business'
									},
					NICKNAME_EXISTS:
									{
										EN: 'License Plate Number already exists.',
										SP: 'License Plate Number already exists'
									},
					ERROR_LICENSE:
									{
										EN: 'Please enter license plate number',
										SP: 'Please enter license plate number'
									},
					ENTER_VALID_PHONE_NUMBER:
									{
										EN: 'Enter a valid phone number',
										SP: 'Enter a valid phone number'
									},
					ENTER_VALID_DES_PIN:
									{
										EN: 'Enter a Valid Designee’s pin',
										SP: 'Enter a Valid Designee’s pin'
									},
					ENTER_VALID_SA_PIN:
									{
										EN: 'Enter a Valid Signing authority pin',
										SP: 'Enter a Valid Signing authority pin'
									},
					VALID_PAST_DATE:
									{
										EN: 'Date should be a past date.',
										SP: 'Date should be a past date.'
									},
					PAYMENT_TERM_CONTIDION: 
									{
										EN: 'Please accept the payment conditions to proceed.', 
										SP: 'Please accept the payment conditions to proceed.'
									},
					FULLNAME_ERROR:
									{
										EN: 'Enter the Full Name.',
										SP: 'Enter the Full Name.'
									},
					TAX_CONSENT_ERROR:
									{
										EN: 'Please check the consent for submission approval.',
										SP: 'Please check the consent for submission approval.'
									},
					VIN_TYPE:
									{
										EN: 'Please select type of VIN correction',
										SP: 'Please select type of VIN correction'
									},
					TAX_GROSWT:
									{
										EN: 'Please select the taxable gross weight.',
										SP: 'Please select the taxable gross weight.'
									},
				}
	
	document.getElementById(returnId).innerHTML = defineArr[key][lang];	 
}
