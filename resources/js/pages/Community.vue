<template>
  <main>
    <section class="w-full h-full p-5">
      <div class="container mx-auto flex flex-wrap">
        <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
          <div
            data-modal-target="post-modal"
            data-modal-toggle="post-modal"
            class="container flex p-4 bg-white rounded-lg gap-4 items-center shadow-sm cursor-pointer mb-7"
          >
            <div class="card_image">
              <img
                :src="
                  userData.image
                    ? `/storage/${userData.image}`
                    : 'https://dummyimage.com/300x300'
                "
                alt=""
                class="hidden object-cover w-10 h-10 rounded-full sm:block"
              />
            </div>
            <div class="card_text">
              <h3 class="font-semibold tracking-wide text-lg text-gray-400">
                Write something
              </h3>
            </div>
          </div>

          <div
            class="container mx-auto flex flex-wrap mt-4"
            v-for="post in getPostData"
            :key="post.id"
          >
            <div
              class="max-w-2xl w-full px-4 py-4 overflow-hidden duration-300 bg-white rounded-lg dark:bg-dark-2 shadow-1 hover:shadow-3 dark:shadow-card dark:hover:shadow-3 hover:shadow-md"
            >
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <img
                    class="hidden object-cover w-10 h-10 rounded-full sm:block"
                    :src="`/storage/${post.author_image}`"
                    alt="avatar"
                  />
                  <p
                    class="font-bold text-gray-700 cursor-pointer dark:text-gray-200"
                  >
                    {{ post.author_name }}
                  </p>
                </div>
                <div
                  v-if="post.user_id == user.id"
                  class="flex items-center gap-3"
                >
                  <!-- Edit Post -->

                  <button
                    id="dropdownMenuIconButton"
                    data-dropdown-toggle="dropdownDots"
                    data-dropdown-placement="bottom-start"
                    class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600"
                    type="button"
                  >
                    <svg
                      class="w-4 h-4 text-gray-500 dark:text-gray-400"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor"
                      viewBox="0 0 4 15"
                    >
                      <path
                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"
                      />
                    </svg>
                  </button>
                  <div
                    id="dropdownDots"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 dark:divide-gray-600"
                  >
                    <ul
                      class="py-2 text-sm text-gray-700 dark:text-gray-200"
                      aria-labelledby="dropdownMenuIconButton"
                    >
                      <li>
                        <a
                          @click="selectPost(post.id)"
                          data-modal-target="edit-modal"
                          data-modal-toggle="edit-modal"
                          class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                          >Edit</a
                        >
                      </li>

                      <li>
                        <a
                          @click="deletePost(post.id)"
                          class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                          >Delete</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="mt-2">
                <p
                  class="text-xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200"
                >
                  {{ post.post_title }}
                </p>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                  {{ post.post_description }}
                </p>
              </div>
              <div class="flex items-center mt-4">
                <div class="flex items-center gap-2">
                  <svg
                    @click="likePost(post)"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 cursor-pointer"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"
                    />
                  </svg>

                  <p
                    class="text-gray-700 dark:text-gray-200"
                    tabindex="0"
                    role="link"
                  >
                    {{ post.like ? post.like : 0 }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="lg:w-2/6 md:w-1/2 px-7 rounded-lg flex flex-col md:ml-auto w-full mt-10 md:mt-0"
        >
          <div
            class="w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-sm dark:bg-gray-800"
          >
            <img
              class="object-cover object-center w-full h-56"
              :src="`/storage/${groupData.group_picture}`"
              alt="avatar"
            />

            <div class="px-6 py-4">
              <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                {{ groupData.group_name }}
              </h1>

              <p class="py-2 text-gray-700 dark:text-gray-400">
                {{ groupData.group_description }}
              </p>

              <div class="flex items-center font-semibold">
                <div class="flex items-center gap-10">
                  <p
                    class="text-gray-700 dark:text-gray-200"
                    tabindex="0"
                    role="link"
                  >
                    Members
                  </p>
                  <p
                    class="text-gray-700 dark:text-gray-200"
                    tabindex="0"
                    role="link"
                  >
                    Online
                  </p>
                  <p
                    class="text-gray-700 dark:text-gray-200"
                    tabindex="0"
                    role="link"
                  >
                    Admin
                  </p>
                </div>
              </div>
              <div class="flex flex-col w-full max-w-xs gap-y-5 pt-7">
                <button
                  data-modal-target="setting-modal"
                  data-modal-toggle="setting-modal"
                  class="bg-white flex items-center text-gray-700 dark:text-gray-300 justify-center gap-x-3 text-sm sm:text-base dark:bg-gray-900 dark:border-gray-700 dark:hover:bg-gray-800 rounded-lg hover:bg-gray-100 duration-300 transition-colors border px-8 py-2.5"
                >
                  <span>SETTINGS</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Post Modal -->
      <div
        id="post-modal"
        tabindex="-1"
        aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
      >
        <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
              class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600 gap-2"
            >
              <div class="card_image">
                <img
                  :src="`/storage/${userData.image}`"
                  alt=""
                  class="h-[30px] rounded-full"
                />
              </div>
              <h5 class="text-sm font-semibold text-gray-900 dark:text-white">
                {{ userData.name }}
              </h5>
              <h5 class="text-sm text-gray-400 dark:text-white">posting in</h5>
              <h5 class="text-sm font-semibold text-gray-900 dark:text-white">
                {{ groupData.group_name }}
              </h5>
              <button
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="post-modal"
              >
                <svg
                  class="w-3 h-3"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 14 14"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                  />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <form>
              <div class="p-4 md:p-5 space-y-4">
                <div class="mb-6">
                  <input
                    type="text"
                    id="post_title"
                    name="post_title"
                    placeholder="Title"
                    v-model="postData.post_title"
                    class="border-gray-200 text-gray-900 text-sm rounded-lg 0 block w-full p-2.5 focus:border-gray-200 focus:ring-0"
                  />
                  <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ errors.post_title }}
                  </small>
                </div>
                <div
                  class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600"
                >
                  <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                    <textarea
                      id="post_description"
                      name="post_description"
                      rows="4"
                      class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                      placeholder="Write a comment..."
                      v-model="postData.post_description"
                    ></textarea>
                  </div>
                </div>
                <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                  {{ errors.post_description }}
                </small>
              </div>
              <!-- Modal footer -->
              <div
                class="flex items-center p-4 md:p-5 rounded-b dark:border-gray-600"
              >
                <button
                  v-show="!isLoading"
                  type="button"
                  name="post_submit"
                  class="text-black bg-[#f8d48199] hover:bg-[#f8d48199] focus:ring-0 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  @click="handleSubmit()"
                >
                  POST
                </button>
                <button
                  v-show="isLoading"
                  disabled
                  type="button"
                  class="text-black bg-[#f8d48199] hover:bg-[#f8d48199] focus:ring-0 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                  <svg
                    aria-hidden="true"
                    role="status"
                    class="inline w-4 h-4 me-3 text-black/80 animate-spin"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                      fill="#E5E7EB"
                    />
                    <path
                      d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                      fill="currentColor"
                    />
                  </svg>
                  LOADING...
                </button>
                <button
                  data-modal-hide="post-modal"
                  type="button"
                  class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                >
                  CANCEL
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Setting Modal -->
      <div
        id="setting-modal"
        tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen"
      >
        <div class="relative w-full max-w-5xl h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full overflow-auto">
            <!-- Modal header -->
            <div
              class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
            >
              <div class="row">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                  {{ groupData.group_name }}
                </h3>
                <small>Group settings</small>
              </div>
              <button
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="setting-modal"
              >
                <svg
                  class="w-3 h-3"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 14 14"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                  />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
              <div class="mb-4 flex">
                <ul
                  class="flex flex-col mr-4 text-sm font-medium text-center"
                  id="default-styled-tab"
                  data-tabs-toggle="#default-styled-tab-content"
                  data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                  data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                  role="tablist"
                >
                  <li class="mb-2" role="presentation">
                    <button
                      class="inline-block w-full p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                      id="dashboard-styled-tab"
                      data-tabs-target="#styled-dashboard"
                      type="button"
                      role="tab"
                      aria-controls="dashboard"
                      aria-selected="false"
                    >
                      Dashboard
                    </button>
                  </li>
                  <li class="mb-2" role="presentation">
                    <button
                      class="inline-block w-full p-4 border-b-2 rounded-t-lg"
                      id="general-styled-tab"
                      data-tabs-target="#styled-general"
                      type="button"
                      role="tab"
                      aria-controls="general"
                      aria-selected="false"
                    >
                      General
                    </button>
                  </li>
                  <li class="mb-2" role="presentation">
                    <button
                      class="inline-block w-full p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                      id="category-styled-tab"
                      data-tabs-target="#styled-category"
                      type="button"
                      role="tab"
                      aria-controls="category"
                      aria-selected="false"
                    >
                      Categories
                    </button>
                  </li>
                </ul>
                <div id="default-styled-tab-content" class="flex-1">
                  <div
                    class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                    id="styled-dashboard"
                    role="tabpanel"
                    aria-labelledby="dashboard-tab"
                  >
                    Dashboard
                  </div>
                  <div
                    class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 h-[100%]"
                    id="styled-general"
                    role="tabpanel"
                    aria-labelledby="general-tab"
                  >
                    <form class="mx-auto">
                      <div
                        class="grid-rows-4 grid-flow-col gap-4 flex justify-between"
                      >
                        <div>
                          <label
                            for="group_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Icon</label
                          >
                          <div class="flex justify-center">
                            <img
                              :src="
                                groupIcon
                                  ? groupIcon
                                  : `/storage/${groupData.group_icon}`
                              "
                              alt=""
                              class="rounded-full h-52 p-5"
                              @click="openFileInputIcon"
                            />
                          </div>
                          <div class="mb-3">
                            <input
                              type="file"
                              class="form-control block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                              id="icon"
                              name="icon"
                              aria-label="Upload"
                              ref="fileInputIcon"
                              @change="handleFileChangeIcon"
                            />
                          </div>
                        </div>
                        <div>
                          <label
                            for="group_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Group Cover Image</label
                          >
                          <div class="flex justify-center">
                            <img
                              :src="
                                groupImage
                                  ? groupImage
                                  : `/storage/${groupData.group_picture}`
                              "
                              alt=""
                              class="rounded-3xl h-52 p-5"
                              @click="openFileInput"
                            />
                          </div>
                          <div class="mb-3">
                            <input
                              type="file"
                              class="form-control block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                              id="image"
                              name="image"
                              aria-label="Upload"
                              ref="fileInput"
                              @change="handleFileChange"
                            />
                          </div>
                        </div>
                      </div>
                      <div class="mb-5">
                        <label
                          for="group_name"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Group Name</label
                        >
                        <input
                          type="text"
                          id="group_name"
                          v-model="group.group_name"
                          name="group_name"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />
                      </div>
                      <div class="mb-5">
                        <label
                          for="group_description"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Group Description</label
                        >
                        <textarea
                          id="group_description"
                          v-model="group.group_description"
                          name="group_description"
                          rows="4"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="Group Description"
                        ></textarea>
                      </div>

                      <button
                        v-show="!isLoading"
                        type="button"
                        @click="handleUpdate()"
                        class="text-black/80 bg-[#f1d07c] focus:ring-0 rounded-lg me-2 mb-2 border w-full py-2 font-bold tracking-wide mt-3"
                      >
                        UPDATE
                      </button>
                      <button
                        v-show="isLoading"
                        disabled
                        type="button"
                        class="text-black/80 bg-[#f1d07c] rounded-lg me-2 mb-2 border w-full py-2 font-bold tracking-wide mt-3"
                      >
                        <svg
                          aria-hidden="true"
                          role="status"
                          class="inline w-4 h-4 me-3 text-black/80 animate-spin"
                          viewBox="0 0 100 101"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="#E5E7EB"
                          />
                          <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentColor"
                          />
                        </svg>
                        LOADING...
                      </button>
                    </form>
                  </div>

                  <div
                    class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                    id="styled-category"
                    role="tabpanel"
                    aria-labelledby="category-tab"
                  >
                    Categories
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Post modal -->
      <div
        id="edit-modal"
        tabindex="-1"
        aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
      >
        <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
              class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600"
            >
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Edit Post
              </h3>
              <button
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="edit-modal"
              >
                <svg
                  class="w-3 h-3"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 14 14"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                  />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <div v-for="post in getPostDatav2" :key="post.id" class="">
              <form @submit.prevent="updatePost(post.id)">
                <div class="p-4 md:p-5 space-y-4">
                  <div class="mb-6">
                    <input
                      type="text"
                      id="post_title"
                      name="post_title"
                      placeholder="Title"
                      v-model="post.post_title"
                      class="border-gray-200 text-gray-900 text-sm rounded-lg 0 block w-full p-2.5 focus:border-gray-200 focus:ring-0"
                    />
                    <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                      {{ errors.post_title }}
                    </small>
                  </div>
                  <div
                    class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600"
                  >
                    <div
                      class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800"
                    >
                      <textarea
                        id="post_description"
                        name="post_description"
                        rows="4"
                        class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                        placeholder="Write a comment..."
                        v-model="post.post_description"
                      ></textarea>
                    </div>
                  </div>
                  <small class="mt-2 text-sm text-red-600 dark:text-red-500">
                    {{ errors.post_description }}
                  </small>
                </div>
                <!-- Modal footer -->
                <div
                  class="flex items-center p-4 md:p-5 rounded-b dark:border-gray-600"
                >
                  <button
                    v-show="!isLoading"
                    type="submit"
                    name="post_submit"
                    class="text-black bg-[#f8d48199] hover:bg-[#f8d48199] focus:ring-0 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    POST
                  </button>
                  <button
                    v-show="isLoading"
                    disabled
                    type="button"
                    class="text-black bg-[#f8d48199] hover:bg-[#f8d48199] focus:ring-0 font-medium rounded-lg text-sm px-8 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    <svg
                      aria-hidden="true"
                      role="status"
                      class="inline w-4 h-4 me-3 text-black/80 animate-spin"
                      viewBox="0 0 100 101"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"
                      />
                      <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"
                      />
                    </svg>
                    LOADING...
                  </button>
                  <button
                    data-modal-hide="post-modal"
                    type="button"
                    class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                  >
                    CANCEL
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>
<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const user = ref({});
const userData = ref({});
const router = useRouter();
const getPostData = ref([]);
const isLoading = ref(false);
const groupImage = ref(null);
const groupIcon = ref(null);
const fileInput = ref(null);
const fileInputIcon = ref(null);
const selectedPostId = ref(null);
const getPostDatav2 = ref([]);

const postData = ref({
  post_title: "",
  post_description: "",
  group_id: router.currentRoute.value.params.id,
  user_id: null,
});

const errors = ref({
  post_title: "",
  post_description: "",
});

const group = ref({
  group_name: "",
  group_description: "",
  group_picture: "",
  group_icon: "",
});
const groupData = ref({
  group_name: "",
  group_description: "",
  group_picture: "",
  group_icon: "",
});

const fetchPosts = async (groupId) => {
  try {
    const response = await axios.get(`/api/posts/show/${groupId}`);
    getPostData.value = response.data;
  } catch (error) {
    console.error(error);
  }
};

async function fetchCreatorName(userID) {
  try {
    const res = await axios.get(`/api/users/${userID}`);
    userData.value = res.data;
  } catch (error) {
    console.error(error);
  }
}

onMounted(async () => {
  try {
    const [meResponse, groupResponse] = await Promise.all([
      axios.get("/api/v1/me"),
      axios.get(`/api/group/${postData.value.group_id}/show`),
    ]);
    user.value = meResponse.data.data;
    postData.value.user_id = user.value.id;
    fetchCreatorName(postData.value.user_id);

    groupData.value = groupResponse.data;
    group.value.group_name = groupData.value.group_name;
    group.value.group_description = groupData.value.group_description;
    fetchPosts(groupData.value.id);
  } catch (error) {
    console.error(error);
  }
});

const handleSubmit = () => {
  let isValid = true;
  if (!postData.value.post_title) {
    errors.value.post_title = "Please Input Title";
    isValid = false;
  }
  if (!postData.value.post_description) {
    errors.value.post_description = "Please Input Description";
    isValid = false;
  }

  if (isValid) {
    isLoading.value = true;
    const formData = new FormData();
    for (const key in postData.value) {
      formData.append(key, postData.value[key]);
    }
    axios
      .post("/api/posts/store", formData)
      .then((response) => {
        alert("Post Submitted!");
        resetForm();
        fetchPosts(postData.value.group_id);
      })
      .catch((error) => {
        console.error("Post Error!", error);
      })
      .finally(() => {
        isLoading.value = false;
      });
  }
};

const resetForm = () => {
  postData.value = {
    post_title: "",
    post_description: "",
    group_id: router.currentRoute.value.params.id,
    user_id: user.value.id,
  };
  errors.value = {
    post_title: "",
    post_description: "",
  };
};

const openFileInput = () => fileInput.value.click();
const openFileInputIcon = () => fileInputIcon.value.click();

const handleFileChange = (event) => {
  const file = event.target.files[0];
  groupImage.value = URL.createObjectURL(file);
  group.value.group_picture = file;
};

const handleFileChangeIcon = (event) => {
  const file_icon = event.target.files[0];
  groupIcon.value = URL.createObjectURL(file_icon);
  group.value.group_icon = file_icon;
};

const handleUpdate = () => {
  isLoading.value = true;
  const formData = new FormData();
  formData.append("group_name", group.value.group_name);
  formData.append("group_description", group.value.group_description);
  if (group.value.group_picture) {
    formData.append("group_picture", group.value.group_picture);
  }
  if (group.value.group_icon) {
    formData.append("group_icon", group.value.group_icon);
  }
  axios
    .post(`/api/group/${postData.value.group_id}/edit`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then((response) => {
      groupData.value = response.data;
      alert("Success Updated");
    })
    .catch((error) => {
      console.error(error);
    })
    .finally(() => {
      isLoading.value = false;
    });
};

const likePost = (post) => {
  axios
    .post(`/api/posts/like/${post.id}`)
    .then((response) => {
      post.like = response.data.like;
    })
    .catch((error) => {
      console.error(error);
    });
};

async function selectPost(postId) {
  selectedPostId.value = postId;
  try {
    const response = await axios.get(`/api/posts/get/${postId}`);
    getPostDatav2.value = response.data;
  } catch (error) {
    console.error(error);
  }
}

async function updatePost(postId) {
  isLoading.value = true;
  try {
    const updatedPost = getPostDatav2.value.find((post) => post.id === postId);
    const response = await axios.put(`/api/posts/${postId}/update`, updatedPost);
    console.log(response.data); // Log the updated post data
    // Fetch the updated post data after updating
    await fetchPosts(response.data.group_id);
    isLoading.value = false;
  } catch (error) {
    console.error(error);
  }
}

async function deletePost(postId) {
  try {
    await axios.delete(`/api/posts/${postId}/delete`);
    // Fetch the updated post data after deletion
    await fetchPosts(postData.value.group_id);
    alert("Post deleted successfully");
  } catch (error) {
    console.error(error);
  }
}
</script>

<style></style>
