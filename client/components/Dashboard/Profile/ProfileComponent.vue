<template>
  <div class="container mx-auto mt-20 w-5/12">
    <div class="border-b border-gray-200">
      <ul class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0"
        id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">

        <li class="inline-block my-0.5 mx-1.5" role="presentation">
          <button @click.prevent="tabButtonTriggered('profile')"
            :class="['text-xs tracking-widest font-medium transition duration-300 ease-in-out hover:text-secondary', selectedTab === 'profile' ? '!text-accent' : 'text-primary']"
            id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
            aria-selected="true">
            Profile
          </button>
        </li>

        <li class="inline-block my-0.5 mx-1.5" role="presentation">
          <button @click.prevent="tabButtonTriggered('statistics')"
            :class="['text-xs tracking-widest font-medium transition duration-300 ease-in-out hover:text-secondary', selectedTab === 'statistics' ? '!text-accent' : 'text-primary']"
            id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab" aria-controls="statistics"
            aria-selected="false">
            Statistics
          </button>
        </li>

        <li class="inline-block my-0.5 mx-1.5" role="presentation">
          <button @click.prevent="tabButtonTriggered('settings')"
            :class="['text-xs tracking-widest font-medium transition duration-300 ease-in-out hover:text-secondary', selectedTab === 'settings' ? '!text-accent' : 'text-primary']"
            id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"
            aria-selected="false">
            Settings
          </button>
        </li>

      </ul>
    </div>

    <div id="default-tab-content" class="mt-2">
      <div class="hidden" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <p>{{ userData }}</p>
      </div>

      <div class="hidden" id="statistics" role="tabpanel" aria-labelledby="profile-tab">
        <p>Statistics text</p>
      </div>

      <div class="hidden" id="settings" role="tabpanel" aria-labelledby="settings-tab">
        <p>Settings text</p>
      </div>

    </div>

  </div>
</template>

<script setup>
import { initFlowbite, initTabs } from 'flowbite';
import { ref } from "vue";
const selectedTab = ref('profile')
const auth = useAuthStore();

const userData = ref({
  id: auth.user.data.id,
  email: auth.user.data.email,
  created_at: auth.user.data.created_at.split('T')[0]
});

const tabButtonTriggered = (tab) => {
  selectedTab.value = tab;
}

</script>