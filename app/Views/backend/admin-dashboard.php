<?php if (session()->get('isLoggedIn')): ?>
    <div class="p-4">
        <div class="flex items-center space-x-4 p-2 rounded-lg bg-primary/10">
            <div class="p-2 rounded-full bg-primary flex items-center justify-center text-white">
                <i class="fas fa-user-tie"></i>
            </div>
            <span>
                <p class="font-medium"><?= session()->get('user_name') ?></p>
                <p class="text-xs text-gray-500">Admin</p>
            </span>
        </div>
    </div>
<?php endif; ?>

<!-- MAIN CONTENT -->
<main class="p-6">

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <!-- Active Students -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Active Students</p>
                    <h3 class="text-2xl font-bold">145</h3>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-primary">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-500 text-sm font-medium">+12 this month</span>
            </div>
        </div>

        <!-- Upcoming Batches -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Upcoming Batches</p>
                    <h3 class="text-2xl font-bold">6</h3>
                </div>
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-700">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-blue-500 text-sm font-medium">Starts next week</span>
            </div>
        </div>

        <!-- Certified Instructors -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Certified Instructors</p>
                    <h3 class="text-2xl font-bold">18</h3>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-500 text-sm font-medium">+2 added</span>
            </div>
        </div>

        <!-- Simulator Usage -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Simulator Usage</p>
                    <h3 class="text-2xl font-bold">82%</h3>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-plane-departure text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-purple-500 text-sm font-medium">High demand</span>
            </div>
        </div>

    </div>


    <!-- COURSES + RECENT ACTIVITY SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- ONGOING COURSES -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow overflow-hidden">

                <div class="p-6 border-b">
                    <h2 class="text-lg font-semibold">Ongoing Aviation Courses</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Progress</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            <tr>
                                <td class="px-6 py-4">Commercial Pilot License (CPL)</td>
                                <td class="px-6 py-4">Pilot Training</td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-primary h-2.5 rounded-full" style="width: 60%"></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs font-semibold bg-green-100 text-green-800 rounded-full">
                                        In Progress
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4">Cabin Crew Certification</td>
                                <td class="px-6 py-4">Crew Training</td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-primary h-2.5 rounded-full" style="width: 40%"></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                        Starting Soon
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="px-6 py-4">Aircraft Maintenance Engineering (AME)</td>
                                <td class="px-6 py-4">Engineering</td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-primary h-2.5 rounded-full" style="width: 85%"></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">
                                        Practicals
                                    </span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t text-right">
                    <a href="#" class="text-primary hover:underline">View All Courses</a>
                </div>

            </div>
        </div>

        <!-- RECENT ACTIVITY -->
        <div>
            <div class="bg-white rounded-lg shadow overflow-hidden">

                <div class="p-6 border-b">
                    <h2 class="text-lg font-semibold">Recent Activity</h2>
                </div>

                <div class="p-6 space-y-4">

                    <div class="flex items-start space-x-3">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-plane text-primary"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Simulator session completed</p>
                            <p class="text-sm text-gray-500">CPL Batch 2025</p>
                            <p class="text-xs text-gray-400">1 hour ago</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-user-graduate text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Student cleared DGCA exam</p>
                            <p class="text-sm text-gray-500">AME Batch</p>
                            <p class="text-xs text-gray-400">Yesterday</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                            <i class="fas fa-chalkboard-teacher text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">New instructor joined</p>
                            <p class="text-sm text-gray-500">Flight Training Team</p>
                            <p class="text-xs text-gray-400">2 days ago</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium">Maintenance scheduled</p>
                            <p class="text-sm text-gray-500">Flight Simulator Room</p>
                            <p class="text-xs text-gray-400">3 days ago</p>
                        </div>
                    </div>

                </div>

                <div class="p-4 border-t text-right">
                    <a href="#" class="text-primary hover:underline">View All Activity</a>
                </div>

            </div>
        </div>

    </div>


    <!-- WEEKLY TRAINING PROGRESS -->
    <div class="mt-6">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold">Weekly Training Progress</h2>
            </div>

            <div class="p-6">
                <div class="h-64">

                    <div class="flex items-end h-48 space-x-2">
                        <div class="flex-1 bg-blue-400 rounded-t" style="height: 70%"></div>
                        <div class="flex-1 bg-blue-300 rounded-t" style="height: 55%"></div>
                        <div class="flex-1 bg-blue-500 rounded-t" style="height: 85%"></div>
                        <div class="flex-1 bg-blue-200 rounded-t" style="height: 45%"></div>
                        <div<div class="flex-1 bg-blue-600 rounded-t" style="height: 90%"></div>
                    </div>

                    <div class="flex mt-4 text-xs text-gray-500">
                        <div class="flex-1 text-center">Mon</div>
                        <div class="flex-1 text-center">Tue</div>
                        <div class="flex-1 text-center">Wed</div>
                        <div class="flex-1 text-center">Thu</div>
                        <div class="flex-1 text-center">Fri</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>