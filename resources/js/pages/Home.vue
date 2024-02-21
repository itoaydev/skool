<template>
  <main>
    <div class="md:container md:mx-auto">
      <section class="bg-gray-2 dark:bg-dark pb-10 lg:pt-[25px] lg:pb-5">
        <div class="flex justify-center items-center flex-col mb-10">
          <h1 class="max-w-md text-4xl font-bold leading-none sm:text-4xl mb-2">
            Discover communities
          </h1>
          <h5 class="text-lg mb-4 font-semibold">
            or
            <RouterLink to="/create-group"
              ><span class="text-blue-400/100"
                >create your own</span
              ></RouterLink
            >
          </h5>
          <form role="search" @submit.prevent="searchGroups">
            <div class="relative w-[40vw]">
              <div
                class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
              >
                <svg
                  class="w-4 h-4 text-gray-500 dark:text-gray-400"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 20 20"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                  />
                </svg>
              </div>
              <input
                type="search"
                v-model="searchQuery"
                id="default-search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search"
                required
              />
            </div>
          </form>
        </div>
        <div class="container mx-auto">
          <div class="flex flex-wrap" style="padding: 1vw 10vw">
            <template v-for="(group, index) in filteredGroups" :key="index">
              <div class="w-full px-4 md:w-1/2 xl:w-1/3">
                <router-link
                  :to="{ name: 'groupDetails', params: { id: group.id } }"
                >
                  <div
                    class="mb-10 overflow-hidden duration-300 bg-white rounded-lg dark:bg-dark-2 shadow-1 hover:shadow-3 dark:shadow-card dark:hover:shadow-3 hover:shadow-md"
                  >
                    <img
                      :src="`/storage/${group.group_picture}`"
                      alt="image"
                      class="w-full"
                      style="height: 200px; object-fit: cover"
                    />
                    <div class="p-2 sm:p-6 md:p-6 xl:p-6">
                      <div class="flex items-center gap-3 mb-5">
                        <img
                          class="hidden object-cover w-10 h-10 rounded-lg sm:block"
                          :src="`/storage/${group.group_icon}`"
                          alt="avatar"
                        />
                        <p
                          class="font-bold text-gray-700 cursor-pointer dark:text-gray-200"
                        >
                          {{ group.group_name }}
                        </p>
                      </div>
                      <p
                        class="text-base leading-relaxed text-body-color dark:text-dark-6 mb-7"
                      >
                        {{ group.group_description }}
                      </p>

                      <div class="flex items-center">
                        <div class="flex items-center gap-3">
                          <p
                            class="text-gray-700 dark:text-gray-200"
                            tabindex="0"
                            role="link"
                          >
                            Private
                          </p>
                          <p
                            class="text-gray-700 dark:text-gray-200"
                            tabindex="0"
                            role="link"
                          >
                            73.2K Members
                          </p>
                          <p
                            class="font-semibold text-gray-700 dark:text-gray-200"
                            tabindex="0"
                            role="link"
                          >
                            Free
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </router-link>
              </div>
            </template>
          </div>
        </div>
      </section>
    </div>
  </main>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted, computed } from "vue";

const groups = ref([]);
const searchQuery = ref("");

const getGroups = () => {
  axios
    .get("api/group")
    .then((res) => (groups.value = res.data))
    .catch((error) => console.log(error));
};

onMounted(() => getGroups());

const filteredGroups = computed(() => {
  return groups.value.filter((group) =>
    group.group_name.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

const searchGroups = () => {
  filteredGroups.value = groups.value.filter((group) =>
    group.group_name.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
};
</script>
