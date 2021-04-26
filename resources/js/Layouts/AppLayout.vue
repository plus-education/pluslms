<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/dashboard">
                                <img src="/img/logo.png" alt="" with="50">
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <jet-nav-link href="/dashboard" :active="$page.currentRouteName == 'dashboard'">
                                Dashboard
                            </jet-nav-link>


                            <jet-nav-link
                                class="bg-gray-100"
                                href="/gradebook"
                                :active="$page.currentRouteName == 'gradebook'">
                                <div class="flex items-center">
                                    <div class="flex-shrink">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                        </svg>
                                    </div>

                                    <div class="flex-1">
                                        Notas
                                    </div>
                                </div>
                            </jet-nav-link>
                        </div>
                    </div>

                    <div class="flex">
                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                                        </button>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <jet-dropdown-link href="/user/profile">
                                            Profile
                                        </jet-dropdown-link>

                                        <jet-dropdown-link href="/user/api-tokens" v-if="$page.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Management -->
                                        <template v-if="$page.jetstream.hasTeamFeatures">
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Team
                                            </div>

                                            <!-- Team Settings -->
                                            <jet-dropdown-link :href="'/teams/' + $page.user.current_team.id">
                                                Team Settings
                                            </jet-dropdown-link>

                                            <jet-dropdown-link href="/teams/create" v-if="$page.jetstream.canCreateTeams">
                                                Create New Team
                                            </jet-dropdown-link>

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Team Switcher -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Switch Teams
                                            </div>

                                            <template v-for="team in $page.user.all_teams">
                                                <form @submit.prevent="switchToTeam(team)">
                                                    <jet-dropdown-link as="button">
                                                        <div class="flex items-center">
                                                            <svg v-if="team.id == $page.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            <div>{{ team.name }}</div>
                                                        </div>
                                                    </jet-dropdown-link>
                                                </form>
                                            </template>

                                            <div class="border-t border-gray-100"></div>
                                        </template>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Logout
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>
                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <!-- Notifications -->
                        <notifications-bell></notifications-bell>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <jet-responsive-nav-link href="/dashboard" :active="$page.currentRouteName == 'dashboard'">
                        Dashboard
                    </jet-responsive-nav-link>

                    <jet-responsive-nav-link href="/gradebook" :active="$page.currentRouteName == 'gradebook'">
                        Notas
                    </jet-responsive-nav-link>

                    <jet-responsive-nav-link href="/gradebook" :active="$page.currentRouteName == 'gradebook'">
                        Notas
                    </jet-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                        </div>

                        <div class="ml-3">
                            <div class="font-medium text-base text-gray-800">{{ $page.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link href="/user/profile" :active="$page.currentRouteName == 'profile.show'">
                            Profile
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Logout
                            </jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        <template v-if="$page.jetstream.hasTeamFeatures">
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Team
                            </div>

                            <!-- Team Settings -->
                            <jet-responsive-nav-link :href="'/teams/' + $page.user.current_team.id" :active="$page.currentRouteName == 'teams.show'">
                                Team Settings
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link href="/teams/create" :active="$page.currentRouteName == 'teams.create'">
                                Create New Team
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Switch Teams
                            </div>

                            <template v-for="team in $page.user.all_teams">
                                <form @submit.prevent="switchToTeam(team)">
                                    <jet-responsive-nav-link as="button">
                                        <div class="flex items-center">
                                            <svg v-if="team.id == $page.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <div>{{ team.name }}</div>
                                        </div>
                                    </jet-responsive-nav-link>
                                </form>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <notifications position="bottom right"/>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>
    </div>
</template>

<script>
    import JetApplicationLogo from './../Jetstream/ApplicationLogo'
    import JetApplicationMark from './../Jetstream/ApplicationMark'
    import JetDropdown from './../Jetstream/Dropdown'
    import JetDropdownLink from './../Jetstream/DropdownLink'
    import JetNavLink from './../Jetstream/NavLink'
    import JetResponsiveNavLink from './../Jetstream/ResponsiveNavLink'
    import NotificationsBell from "./Notifications";

    export default {
        components: {
            JetApplicationLogo,
            JetApplicationMark,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            NotificationsBell
        },

        data() {
            return {
                showingNavigationDropdown: false
            }
        },

        mounted() {
            Echo.private('App.Models.User.' + this.$page.user.id)
                .notification((notification) => {
                    console.log(notification)
                    this.$notify({
                        title: notification.title,
                        text: 'You have been logged in!',
                        duration: 6000
                    })
                });
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put('/current-team', {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                axios.post('/logout').then(response => {
                    window.location = '/';
                })
            },
        },

        computed: {
            path() {
                return window.location.pathname
            }
        }
    }
</script>
