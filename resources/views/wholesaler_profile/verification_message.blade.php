<div class="profile_verification_request_block">
    <div class="card-alert card orange">
        @if($business_profile->businessProfileVerificationsRequest)
        <div class="card-content white-text">
            <p>WARNING : Your request is awaiting for verification. <a href="#send-verification-request-modal" class="send-verification-request-trigger modal-trigger">Resend Request</a></p>
        </div>
        @else
        <div class="card-content white-text">
            <p>WARNING : Your profile is not verified. <a href="#send-verification-request-modal" class="send-verification-request-trigger modal-trigger">Send Request</a></p>
        </div>
        @endif
    </div>										
</div>	