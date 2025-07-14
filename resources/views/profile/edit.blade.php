<x-app-layout>
    <x-slot name="header">
        <h1 class="h3 mb-4 text-gray-800">Pengaturan Profil</h1>
    </x-slot>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Informasi Profil -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-user-cog mr-1"></i> Informasi Profil</h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Ganti Password -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="fas fa-key mr-1"></i> Ganti Password</h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Hapus Akun -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><i class="fas fa-user-times mr-1"></i> Hapus Akun</h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

                

            </div>
        </div>
    </div>
</x-app-layout>
