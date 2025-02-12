<x-master-layout>
    <style>
        body {
            background: url('your-background-image.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .welcome-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 30px;
        }
    </style>
    
    <div class="container d-flex justify-content-center align-items-center min-vh-50">
        <div class="col-md-8">
            <div class="card welcome-card text-center shadow-lg">
                <div class="card-body">
                    <img src="images/logo.svg" alt="Logo" width="200" class="mb-3">
                    <h2 class="text-primary">{{ __('messages.welcome') }}</h2>
                    <p class="text-muted">{{ __('messages.login_succes') }}</p>
                    
                  
                </div>
            </div>
        </div>
    </div>
    
</x-master-layout>
