<?php
defined("BASEPATH") or exit("No direct script access allowed");
?>

<div class="flex-1 p-6 lg:p-10">


    <!-- Header Section -->
    <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Users</h1>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <!-- Search & Filter Form -->
            <?php echo form_open('users', array('method' => 'get', 'class' => 'flex flex-wrap items-center gap-3 w-full md:w-auto')); ?>

            <!-- Search Input with Icon -->
            <div class="group relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-400 group-focus-within:text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <input type="search" id="search" name="search"
                    placeholder="Search users..."
                    aria-label="Search"
                    value="<?php echo html_escape($this->input->get('search')); ?>"
                    class="block w-full rounded-lg border border-gray-300 bg-white py-2 pl-10 pr-3 text-center text-sm placeholder-gray-400 shadow-sm outline-none transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 md:w-64">
            </div>

            <button type="submit"
                class="inline-flex cursor-pointer items-center justify-center rounded-lg bg-green-100 px-4 py-2 text-sm font-semibold text-green-600 shadow-sm transition-all hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                Search
            </button>

            <!-- Role Filter Dropdown -->
            <div class="relative">
                <select id="category" name="role" aria-label="Category Filter"
                    onchange="this.form.submit()"
                    class="block w-full cursor-pointer appearance-none rounded-lg border border-gray-300 bg-white px-2 py-2 pl-3 pr-10 text-sm shadow-sm outline-none transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    <option value="">All roles</option>
                    <option value="admin" <?php echo ($this->input->get('role') == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?php echo ($this->input->get('role') == 'user') ? 'selected' : ''; ?>>User</option>
                </select>
                <!-- Custom Dropdown Arrow -->
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <dialog id="userModal" class="fixed z-50 mx-auto mt-12 overflow-hidden rounded-xl border-none bg-white p-4 shadow-xl backdrop:bg-gray-900/60 backdrop:backdrop-blur-xl open:flex open:flex-col">

        <div id="modalContent" class="py-8">

        </div>
    </dialog>

    <!-- Table Container -->
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="w-full border-collapse border border-gray-200 text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border-b border-gray-200 px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Name</th>
                    <th class="border-b border-gray-200 px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500">Email</th>
                    <th class="border-b border-gray-200 px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">Role</th>
                    <th class="border-b border-gray-200 px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                    <th class="border-b border-gray-200 px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (empty($users)) : ?>
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm italic text-gray-500">No users found.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($users as $user) : ?>
                        <tr class="transition-colors hover:bg-gray-50">
                            <!-- User & Image -->
                            <td class="px-6 py-4 transition-colors">
                                <div class="flex items-center gap-3">
                                    <img src="<?php echo base_url('uploads/avatars/' . ($user['img_path'] ?: 'default.jpg')); ?>"
                                        alt="user"
                                        class="h-16 w-16 rounded-full border border-gray-100 object-cover shadow-sm transition-transform">
                                    <a href="javascript:void(0)" class="view-user-details cursor-pointer" data-user-id="<?php echo $user['id']; ?>"><span class="font-semibold text-gray-900"><?php echo $user['username']; ?></span></a>
                                </div>
                            </td>

                            <!-- Email -->
                            <td class="px-6 py-4 text-sm text-gray-600 transition-colors group-hover:bg-indigo-50/80">
                                <?php echo $user['email']; ?>
                            </td>

                            <!-- Role -->
                            <td class="px-6 py-4 text-center transition-colors group-hover:bg-indigo-50/80">
                                <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-bold uppercase text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                                    <?php echo $user['role']; ?>
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center transition-colors group-hover:bg-indigo-50/80">
                                <?php
                                $statusColor = ($user['status'] == 'active') ? 'text-green-700 bg-green-50 ring-green-600/20' : 'text-gray-600 bg-gray-50 ring-gray-500/10';
                                ?>
                                <a href="<?php echo site_url('admin/auth_admin/toggle_status/' . $user['id']); ?>">
                                    <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo $statusColor; ?>">
                                        <span class="mr-1.5 h-1.5 w-1.5 rounded-full fill-current <?php echo ($user['status'] == 'active') ? 'bg-green-600' : 'bg-gray-400'; ?>"></span>
                                        <?php echo ucfirst($user['status']); ?>
                                    </span>
                                </a>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-center transition-colors group-hover:bg-indigo-50/80">
                                <div class="flex justify-center gap-2">
                                    <a href="<?php echo site_url('admin/auth_admin/edit_user/' . $user['id']); ?>"
                                        class="inline-flex items-center rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-amber-600 shadow-sm ring-1 ring-inset ring-amber-500 transition-all hover:bg-amber-50">
                                        Edit
                                    </a>
                                    <a href="<?php echo site_url('admin/auth_admin/delete/' . $user['id']); ?>"
                                        class="inline-flex items-center rounded-lg bg-white px-3 py-1.5 text-xs font-semibold text-red-600 shadow-sm ring-1 ring-inset ring-red-500 transition-all hover:bg-red-50"
                                        onclick="return confirm('Delete this user?')">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>



    <nav aria-label="Pagination" class="isolate mt-6 inline-flex w-full justify-between gap-5 rounded-md">
        <?php

        $params = $this->input->get();

        $params['page'] = max(1, $current_page - 1);
        $prev_url = site_url('admin/auth_admin/index?' . http_build_query($params));

        $params['page'] = min($current_page + 1, ceil($total / 4));
        $next_url = site_url('admin/auth_admin/index?' . http_build_query($params));
        $limit = 4;

        $start_item = ($total > 0) ? ($current_page - 1) * $limit + 1 : 0;

        $end_item = min($current_page * $limit, $total);
        ?>

        <div>
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium"><?php echo $start_item; ?></span>
                to
                <span class="font-medium"><?php echo $end_item; ?></span>
                of
                <span class="font-medium"><?php echo $total; ?></span>
                results
            </p>
        </div>

        <div>
            <!-- Previous Button -->
            <a href="<?php echo $prev_url; ?>"
                class="inset-ring inset-ring-gray-400 relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-700 hover:bg-white/5">
                <span class="sr-only">Previous</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </a>

            <!-- Next Button -->
            <a href="<?php echo $next_url; ?>"
                class="inset-ring inset-ring-gray-400 relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-700 hover:bg-white/5">
                <span class="sr-only">Next</span>
                <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </a>
        </div>
    </nav>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('userModal');
        const modalContent = document.getElementById('modalContent');

        // 1. Open modal (using delegation to handle any dynamic buttons on the page)
        document.addEventListener('click', function(event) {
            const openBtn = event.target.closest('.view-user-details');
            if (openBtn) {
                const userId = openBtn.getAttribute('data-user-id');

                fetch(`<?php echo site_url('admin/auth_admin/get_user_details'); ?>/${userId}`)
                    .then(response => response.text())
                    .then(data => {
                        modalContent.innerHTML = data;
                        // Native HTML Dialog method:
                        modal.showModal();
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                        alert('Could not load user data.');
                    });
            }
        });

        // 2. Close modal (Handles "Close" button and Backdrop clicks)
        modal.addEventListener('click', function(event) {
            // If user clicks the <dialog> itself (the backdrop) or the button with ID closeModal
            const isCloseBtn = event.target.closest('#closeModal');
            const isBackdrop = event.target === modal;

            if (isCloseBtn || isBackdrop) {
                modal.close(); // Native HTML Dialog method
                // Optional: clear content after a tiny delay for smoother exit
                setTimeout(() => {
                    modalContent.innerHTML = '';
                }, 200);
            }
        });
    });
</script>