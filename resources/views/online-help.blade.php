<x-help>
    <x-title-page>Online Help</x-title-page>

    <x-horizontal-line></x-horizontal-line>

    <div class="help-container"> 
        <div class="help-body-content"> 
            <!-- Login Section -->
            <h3 id="1">How to Sign In</h3> <!-- Unique ID for bookmarking -->
            <p>1. Enter Username and Password on the entry boxes labeled respectively. Click the checkbox beside the “Remember me” if you want to save your login credentials. Then, click the Sign In button (See Figure 1-1).</p>

            <div class="help-center-image">
                <img src="{{ asset('image/login-form.png') }}" alt="Login Form" class="help-image">
                <p class="help-caption">Figure 1-1 Login Form</p>
            </div>

            <p>2. If login is successful, you will be directed to the Dashboard page.</p>

            <!-- Forgot Password Section -->
            <h3 id="2">How to request Forgot Password</h3> <!-- Unique ID for bookmarking -->
            <p>1. To request a new password, click the Forgot Password button on the login page (See Figure 1-1).</p>
            <p>2. To reset your password, enter the email address for the password reset link. Then, click the Submit button (See Figure 1-2).</p>

            <div class="help-center-image">
                <img src="{{ asset('image/reset-password-email.png') }}" alt="Reset Password Email" class="help-image">
                <p class="help-caption">Figure 1-2 Reset Password Email</p>
            </div>

            <p>3. A password reset email containing the password reset link will be sent to the email address you provided. Click this link and you will be redirected to the Reset Password Form.</p>
            <p>4. Enter your new password on the entry boxes labeled respectively. Then, click the Set Password button (See Figure 1-3).</p>

            <div class="help-center-image">
                <img src="{{ asset('image/reset-password-form.png') }}" alt="Reset Password Form" class="help-image">
                <p class="help-caption">Figure 1-3 Reset Password Form</p>
            </div>

            <!-- Primary Indicators Section -->
            <h3 id="3">How to Select Primary Indicators</h3>
            <p>1. To access primary indicators, open the Navigation Menu and click on Indicators >> Primary Indicators. The Primary Indicators page will display after (See Figure 1-4).</p>

            <div class="help-center-image">
                <img src="{{ asset('image/primary-indicators-page.png') }}" alt="Primary Indicators Image" class="help-image">
                <p class="help-caption">Figure 1-4 Primary Indicators Page</p>
            </div>

            <p>2. To select your primary indicators, click on the Start button. A modal will show up displaying all the primary indicators.</p>
            <p>3. Select your primary indicators by ticking the checkbox beside each indicator you want to select (See Figure 1-5).</p>

            <div class="help-center-image">
                <img src="{{ asset('image/collapsed-selection-form.png') }}" alt="Collapsed Selection Form" class="help-image">
                <p class="help-caption">Figure 1-5 Collapsed Selection Form</p>
            </div>

            <p>4. For easier identification of your desired indicator, you can use the Filter and Search buttons.</p>
            <p>5. To access additional information about each indicator, expand the selection form by clicking the Expand icon on the right side of the selection form. Further information regarding each indicator will be displayed after clicking (See Figure 1-6).</p>

            <div class="help-center-image">
                <img src="{{ asset('image/expanded-selection-form.png') }}" alt="Expanded Selection Form" class="help-image">
                <p class="help-caption">Figure 1-6 Expanded Selection Form</p>
            </div>

            <p>6. After selecting your primary indicators, click the Save button to save your primary indicators.</p>

            <!-- Secondary Indicators Section -->
            <h3 id="4">How to Add Secondary Indicators</h3>
            <p>1. To access secondary indicators, open the Navigation Menu and click on Indicators >> Secondary Indicators. The Secondary Indicators page will display after (See Figure 1-7).</p>

            <div class="help-center-image">
                <img src="{{ asset('image/secondary-indicators-page.png') }}" alt="Secondary Indicators Image" class="help-image">
                <p class="help-caption">Figure 1-7 Secondary Indicators Page</p>
            </div>

            <p>2. To add your secondary indicators, click on the Start button. A modal will show up displaying a form for adding secondary indicators (See Figure 1-8).</p>

            <div class="help-center-image">
                <img src="{{ asset('image/secondary-indicators-form.png') }}" alt="Secondary Indicators Form" class="help-image">
                <p class="help-caption">Figure 1-8 Secondary Indicators Form</p>
            </div>

            <p>3. Enter all the necessary details and information regarding the indicator that you want to add on the entry boxes of the form.</p>
            <p>4. After entering all the necessary information, click the Add button to successfully add your secondary indicator. A popup box will display indicating the successful addition of your secondary indicator (See Figure 1-9).</p>

            <div class="help-center-image">
                <img src="{{ asset('image/success-popup.png') }}" alt="Success Popup" class="help-image">
                <p class="help-caption">Figure 1-9 Success Popup</p>
            </div>
        </div>    
    </div>
</x-help>
