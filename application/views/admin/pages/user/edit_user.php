<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="min-h-screen bg-slate-50/50 px-4 py-12 font-sans text-slate-900 antialiased sm:px-6 lg:px-8">
    <div class="mx-auto max-w-3xl">

        <!-- Header -->
        <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">
                    User Settings
                </h1>
            </div>
            <a href="<?php echo site_url('users' . $user['id']); ?>"
                class="inline-flex items-center gap-2 rounded-lg border border-slate-400 px-4 py-2 text-sm font-semibold text-slate-600 transition-all hover:text-indigo-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Directory
            </a>
        </div>

        <!-- Glass Card -->
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] backdrop-blur-sm">

            <form action="<?php echo site_url('admin/auth_admin/edit_user/' . $user['id']); ?>" method="post" enctype="multipart/form-data" class="grid grid-cols-2 divide-y divide-slate-100">

                <!-- Section 1: Profile -->
                <div class="p-8">
                    <h2 class="mb-6 text-lg font-bold text-slate-800">Identity Details</h2>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Username</label>
                            <input type="text" name="username" value="<?php echo set_value('username', $user['username']); ?>"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Email Address</label>
                            <input type="email" name="email" value="<?php echo set_value('email', $user['email']); ?>"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Access Level</label>
                            <select name="role" class="w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
                                <option value="admin" <?php echo set_select('role', 'admin', $user['role'] === 'admin'); ?>>Administrator</option>
                                <option value="user" <?php echo set_select('role', 'user', $user['role'] === 'user'); ?>>Standard User</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Appearance -->
                <div class="bg-slate-50/30 p-8">
                    <h2 class="mb-6 text-lg font-bold text-slate-800">Visual Identity</h2>
                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center">
                        <div class="group relative">
                            <img src="<?php echo base_url('uploads/avatars/' . ($user['img_path'] ?: 'default.jpg')); ?>"
                                class="h-24 w-24 rounded-full border-4 border-white object-cover shadow-xl transition-transform group-hover:scale-105">
                            <div class="absolute -bottom-2 -right-2 rounded-full bg-indigo-600 p-1.5 text-white shadow-lg">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="text-[11px] font-bold uppercase tracking-widest text-slate-400">Upload New Photo</label>
                            <input type="file" name="avatar" class="mt-2 block w-full text-xs text-slate-500 file:mr-4 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Security -->
                <div class="p-8">
                    <h2 class="mb-3 text-lg font-bold text-slate-800">Security Credentials</h2>
                    <div>
                        <label class="text-[11px] font-bold uppercase tracking-widest text-slate-400">New Password (Optional)</label>
                        <input type="password" name="password" placeholder=""
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10">
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-end justify-end gap-3 p-6">
                    <button type="button" onclick="history.back()"
                        class="rounded-xl border border-gray-300 px-6 py-2.5 text-sm font-bold text-slate-600 transition-all hover:bg-slate-200 active:scale-95">
                        Discard
                    </button>
                    <button type="submit"
                        class="rounded-xl bg-indigo-600 px-10 py-2.5 text-sm font-bold text-white shadow-[0_10px_20px_-5px_rgba(79,70,229,0.4)] transition-all hover:-translate-y-0.5 hover:bg-indigo-700 active:translate-y-0 active:scale-95">
                        Update Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>