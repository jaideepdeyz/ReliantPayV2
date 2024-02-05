 


# TODO FOR SENDING SMS
- Validate phone number of dealer during sign up
- Payment successful 
- Booking successful
## POST TODO SMS
- Trip reminder

# Google recaptcha
- {!! RecaptchaV3::initJs() !!} in blade
- {!! RecaptchaV3::field('register') !!} in blade
- 'g-recaptcha-response' => 'required|recaptchav3:register,0.5'

# ERD
php artisan generate:erd