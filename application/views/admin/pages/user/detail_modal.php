<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="text-center">
    <!-- Header/Avatar - Negative margin pulls it into the gradient area -->
    <div class="relative -mt-10 mb-4 inline-block">
        <img src="<?php echo base_url('uploads/avatars/' . ($user['img_path'] ?: 'default.jpg')); ?>"
            alt="User Avatar"
            class="h-16 w-16 rounded-full border-4 border-white object-cover shadow-lg">
        <span class="absolute bottom-1 right-1 h-4 w-4 rounded-full border-3 border-white <?php echo ($user['status'] == 'active') ? 'bg-green-500' : 'bg-gray-400'; ?>"></span>
    </div>

    <h3 class="text-xl font-extrabold text-gray-900"><?php echo $user['username']; ?></h3>
    <p class="mb-4 text-sm font-medium text-gray-500"><?php echo $user['email']; ?></p>

    <!-- Status Badges -->
    <div class="mb-6 flex justify-center gap-2">
        <span class="rounded-full bg-indigo-50 px-3 py-1 text-[10px] font-bold uppercase tracking-tight text-indigo-600 ring-1 ring-inset ring-indigo-200">
            <?php echo $user['role']; ?>
        </span>
        <span class="rounded-full px-3 py-1 text-[10px] font-bold ring-1 ring-inset uppercase tracking-tight <?php echo ($user['status'] == 'active') ? 'bg-green-50 text-green-600 ring-green-200' : 'bg-gray-50 text-gray-500 ring-gray-200'; ?>">
            <?php echo $user['status']; ?>
        </span>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 gap-4 rounded-xl bg-gray-50 p-4 text-left">
        <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400">User ID</label>
            <p class="text-sm font-bold text-gray-700">#<?php echo $user['id']; ?></p>
        </div>
        <div>
            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400">Joined</label>
            <p class="text-sm font-bold text-gray-700"><?php echo date('M Y', strtotime($user['created_at'])); ?></p>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex gap-3">
        <a href="<?php echo site_url('admin/auth_admin/edit_user/' . $user['id']); ?>"
            class="flex-1 rounded-xl bg-white py-2.5 text-sm font-bold text-gray-600 ring-1 ring-inset ring-gray-200 transition-all hover:bg-gray-50">
            Edit
        </a>
        <button id="closeModal"
            class="flex-1 rounded-xl bg-white py-2.5 text-sm font-bold text-gray-600 ring-1 ring-inset ring-gray-200 transition-all hover:bg-gray-50">
            Close
        </button>
    </div>
</div>