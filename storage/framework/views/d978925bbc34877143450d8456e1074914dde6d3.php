<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="side-menu-bt-sidebar small-device-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary wrapper-menu" width="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>
            <div class="d-flex align-items-center">

                <!--<?php if(auth()->user()->hasAnyRole(['admin'])): ?>-->
                <!--<a href="#" class="btn btn-primary text-white" style="float: right !important;margin-right: 10px;">Back to admin</a>-->
                <!--<?php endif; ?>-->
                <!--jabu-->
                <?php if(session()->get('backid')): ?>
                <a href="<?php echo e(route('login.as',session()->get('backid'))); ?>" class="btn btn-primary text-white" style="float: right !important;margin-right: 10px;">Back to admin</a>
                <?php endif; ?>

                <div class="change-mode">
                    <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                        <div class="custom-switch-inner">
                            <p class="mb-0"> </p>
                            <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                            <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                                <span class="switch-icon-left">
                                    <svg class="svg-icon" id="h-sun" height="20" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                                <span class="switch-icon-right">
                                    <svg class="svg-icon" id="h-moon" height="20" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list align-items-center">
                        
                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="search-toggle dropdown-toggle language-toggle" id="languageDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php
                                $selected_lang_flag = file_exists(public_path('/images/flags/' . app()->getLocale() . '.png')) ? asset('/images/flags/' . app()->getLocale() . '.png') : asset('/images/language.png');
                                ?>
                                <img src="<?php echo e($selected_lang_flag); ?>" class="img-fluid" alt="lang" style="height: 30px; min-width: 30px; width: 30px;">
                                <span class="bg-primary"></span>
                            </a>
                            <div class="iq-sub-dropdown dropdown-menu language-dropdown-menu" aria-labelledby="languageDropdownMenu">
                                <div class="card shadow-none m-0 border-0">
                                    <div class=" p-0 ">
                                        <ul class="dropdown-menu-1 list-group list-group-flush">
                                            <?php
                                            $language_option = sitesetupSession('get')->language_option ?? ["nl","fr","it","pt","es","en"];
                                            if (!empty($language_option)) {
                                                $language_array = languagesArray($language_option);
                                            }
                                            ?>
                                            <?php if(count($language_array) > 0 ): ?>
                                            <?php $__currentLoopData = $language_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="dropdown-item-1 list-group-item px-2 <?php echo e(app()->getLocale() == $lang['id'] ? 'active' : ''); ?>">
                                                <a class="p-0" data-lang="<?php echo e($lang['id']); ?>" href="<?php echo e(route('switch-language',['locale'=> $lang['id'] ])); ?>">
                                                    <?php
                                                    $flag_path = file_exists(public_path('/images/flags/' . $lang['id'] . '.png')) ? asset('/images/flags/' . $lang['id'] . '.png') : asset('/images/language.png');
                                                    ?>
                                                    <img src="<?php echo e($flag_path); ?>" alt="img-flag-<?php echo e($lang['id']); ?>" class="img-fluid mr-2" style="width: 20px;height: auto;min-width: 15px;" />
                                                    <?php echo e($lang['title']); ?>

                                                </a>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="nav-item nav-icon dropdown-toggle pr-0 search-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo e(getSingleMedia(auth()->user(),'profile_image')); ?>" class="img-fluid avatar-rounded bg-light" alt="user">
                                <span class="mb-0  user-name"><?php echo e(auth()->user()->name); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="dropdownMenuButton">
                                <li class="dropdown-item d-flex svg-icon">
                                    <svg class="svg-icon mr-0 text-secondary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <a href="<?php echo e(route('login')); ?>"><?php echo e(__('messages.home')); ?></a>
                                </li>
                                <li class="dropdown-item d-flex svg-icon">
                                    <svg class="svg-icon mr-0 text-secondary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    
                                    <a href="<?php echo e(route('setting.index',['page' => 'password_form'])); ?>"><?php echo e(__('messages.change_password')); ?></a>
                                </li>
                                <?php if(auth()->check() && auth()->user()->hasRole('provider')): ?>
                                <li class="dropdown-item d-flex svg-icon">
                                    <svg class="svg-icon mr-0 text-secondary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <a href="<?php echo e(route('provider.show', ['provider' => auth()->id()])); ?>"><?php echo e(__('messages.my_info')); ?></a>
                                </li>
                                <?php endif; ?>
                                
                                <li class="dropdown-item  d-flex svg-icon border-top">
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <svg class="svg-icon mr-0 text-secondary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <a class="logout-link" href="javascript:void(0)" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                            <?php echo e(__('Log out')); ?>

                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<?php /**PATH C:\Users\USER\Desktop\km\resources\views/partials/_body_header.blade.php ENDPATH**/ ?>