<template>
  <section class="w-full h-full">
    <div class="container mx-auto flex flex-wrap bg-white justify-center">
      <div class="lg:w-4/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
        <div class="px-5 py-6">
          <nav class="flex" aria-label="Breadcrumb">
            <ol
              class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
            >
              <li class="inline-flex items-center">
                <a
                  @click="goBack"
                  class="cursor-pointer inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#ffce5b99] dark:text-gray-400 dark:hover:text-white"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="w-5 h-5 me-2.5"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M7.793 2.232a.75.75 0 0 1-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 0 1 0 10.75H10.75a.75.75 0 0 1 0-1.5h2.875a3.875 3.875 0 0 0 0-7.75H3.622l4.146 3.957a.75.75 0 0 1-1.036 1.085l-5.5-5.25a.75.75 0 0 1 0-1.085l5.5-5.25a.75.75 0 0 1 1.06.025Z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  
                  Back
                </a>
              </li>
              <li aria-current="page">
                <div class="flex items-center">
                  <svg
                    class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 6 10"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="m1 9 4-4-4-4"
                    />
                  </svg>
                  <span
                    class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"
                    >Profile Details</span
                  >
                </div>
              </li>
            </ol>
          </nav>
        </div>
        <div class="container px-5 md:px-5 mx-auto space-y-2">
          <div class="md:flex md:justify-between md:space-x-2 py-6">
            <div class="md:w-1/3 pb-4">
              <h3 class="text-xl">Profile</h3>
              <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
              </p>
            </div>
            <profile-update
              class="md:w-2/3 p-4 bg-white shadow-md rounded-lg"
            ></profile-update>
          </div>
          <div class="md:flex md:justify-between md:space-x-2 py-6">
            <div class="md:w-1/3 pb-4">
              <h3 class="text-xl">Profile Image</h3>
              <p class="mt-1 text-sm text-gray-600">
                Update your profile's image.
              </p>
            </div>
            <profile-image
              class="md:w-2/3 p-4 bg-white shadow-md rounded-lg"
            ></profile-image>
          </div>

          <div class="md:flex md:justify-between md:space-x-2 py-6">
            <div class="md:w-1/3 pb-4">
              <h3 class="text-xl">Password</h3>
              <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay
                secure.
              </p>
            </div>
            <password-update
              class="md:w-2/3 p-4 bg-white shadow-md rounded-lg"
            ></password-update>
          </div>

          <div class="md:flex md:justify-between md:space-x-2 py-6">
            <div class="md:w-1/3 pb-4">
              <h3 class="text-xl">Two Factor Authentication</h3>
              <p class="mt-1 text-sm text-gray-600">
                Add additional security to your account using two factor
                authentication.
              </p>
            </div>
            <two-factore-authentication
              class="md:w-2/3 p-4 bg-white shadow-md rounded-lg"
            ></two-factore-authentication>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import TwoFactoreAuthentication from "@/js/components/user/TwoFactoreAuthentication";
import ProfileUpdate from "@/js/components/user/ProfileUpdate";
import PasswordUpdate from "@/js/components/user/PasswordUpdate";
import ProfileImage from "@/js/components/user/ProfileImage";
import { useRouter } from "vue-router";

export default {
  components: {
    TwoFactoreAuthentication,
    ProfileUpdate,
    PasswordUpdate,
    ProfileImage,
  },
  setup() {
    const router = useRouter();

    const goBack = () => {
      router.go(-1);
    };

    return {
      goBack,
    };
  },
};
</script>
