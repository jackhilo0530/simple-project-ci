<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="mx-auto mt-12 flex max-w-7xl justify-center px-4 sm:px-6 lg:px-8">
    <!-- Added hover:shadow-md and transition for a premium feel -->
    <div class="w-full max-w-md">

        <!-- Error Alert -->
        <?php if (isset($error)): ?>
            <div class="mb-6 flex items-center gap-2 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span><?php echo $error; ?></span>
            </div>
        <?php endif; ?>

        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Signin</h1>
        </div>

        <!-- Note: Ensure your controller 'auth/signin' matches this route -->
        <?php echo form_open('signin', array('class' => 'space-y-6')); ?>

        <!-- Username -->
        <div>
            <label for="username" class="mb-1 block text-sm font-medium text-gray-700">Username</label>
            <div class="mb-1 text-xs font-medium text-red-600"><?php echo form_error('username'); ?></div>
            <input type="text" id="username" name="username" placeholder="Your username"
                value="<?php echo set_value('username'); ?>"
                class="focus:outline-hidden block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm placeholder-gray-400 shadow-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Password -->
        <div>
            <div class="mb-1 flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <a href="#" class="text-xs font-semibold text-blue-600 no-underline transition-colors hover:text-blue-500">Forgot password?</a>
            </div>
            <div class="mb-1 text-xs font-medium text-red-600"><?php echo form_error('password'); ?></div>
            <input type="password" id="password" name="password" placeholder="Your password"
                class="focus:outline-hidden block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm placeholder-gray-400 shadow-sm transition-all focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit"
                class="focus:outline-hidden active:scale-98 flex w-full cursor-pointer justify-center rounded-lg border border-transparent bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Signin
            </button>
        </div>

        <!-- Sign up Link -->
        <p class="mt-4 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="<?php echo base_url('signup'); ?>" class="font-semibold text-blue-600 no-underline transition-colors hover:text-blue-500">Sign up</a>
        </p>

        <?php echo form_close(); ?>
    </div>
</div>