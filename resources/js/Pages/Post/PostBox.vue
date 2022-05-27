<template>
  <div class="flex px-4 w-full md:w-2/3">
       <div class="min-w-0 flex-1">
      <form @submit.prevent="submit" class="relative">
        <div class="border border-gray-300 rounded-lg shadow-sm overflow-hidden">
          <label for="comment" class="sr-only">Add your comment</label>
          <input ref="post_upload"  accept="image/*" @change="photoPreview" type="file" class="hidden" />
          <textarea rows="3" class="block w-full focus:none py-3 border-transparent resize-none sm:text-sm rounded-lg" v-model="form.post" placeholder="what&apos;s on your mind..."></textarea>

          <!-- Spacer element to match the height of the toolbar -->
          <div class="py-2" aria-hidden="true">
            <!-- Matches height of button in toolbar (1px border + 36px content height) -->
            <div class="py-px">
              <div class="h-9" />
            </div>
          </div>
        </div>

        <div class="absolute bottom-0 inset-x-0 pl-3 pr-2 py-2 flex justify-between">
            <div class="flex items-center space-x-5">
                <div class="flex items-center">
                    <button type="button" class="-m-2.5 w-10 h-10 rounded-full flex items-center justify-center text-purple-900 hover:text-pink-700" @click="openModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4" viewBox="0 0 24 24"><path d="M18 5l-2-3h-8l-2 3h-6v17h24v-17h-6zm4 7h-4.079c.581 3.754-2.312 7-5.921 7-3.612 0-6.501-3.248-5.921-7h-4.079v-5h5.07l2-3h5.859l2 3h5.071v5zm-10-3c-2.243 0-4 1.73-4 3.939 0 2.239 1.794 4.061 4 4.061s4-1.822 4-4.061c0-2.209-1.757-3.939-4-3.939zm-.436 3.555c-.632.503-1.461.5-1.852-.006-.39-.506-.194-1.324.438-1.827.632-.502 1.461-.499 1.851.007.391.505.195 1.323-.437 1.826z"/></svg>
                        <span class="sr-only">Attach a Image</span>
                    </button>
                </div>
            </div>
            <div class="flex-shrink-0">
                <button type="button" class="ml-4 inline-flex items-center px-4 py-2 bg-pink-900 border border-transparent rounded-md text-xs text-white uppercase tracking-widest hover:bg-pink-700 active:bg-pink-900 focus:outline-none focus:border-pink-900 focus:shadow-outline-blue transition ease-in-out duration-150 mr-2"  @click="makePost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4" viewBox="0 0 24 24"><path d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z"/></svg>
                </button>
            </div>
        </div>
        <post-image-modal :show="showable">
            <template #title>
                upload photos
            </template>
            <template #content>
                <div class="my-2 flex justify-center items-center" v-show="! preview" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-blue-400 h-24 w-24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" @click="openFile">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="my-2 flex justify-center items-center" v-show="preview">
                    <span class="block rounded-full w-48 h-48 cursor-pointer"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + preview + '\');'" @click="openFile">
                    </span>
                </div>
                <div>
                    <input class="w-full rounded-lg" placeholder="Add Comment" type="text" v-model="form.post">

                    <div class="text-red-700 font-bold" v-if="form.error" v-text="form.error"></div>
                </div>

                <div class="pt-3 w-full flex justify-end ml-auto" @click="closeModal">
                    <image-post-button @click="setImageForPost" class="mx-2"  :class="isDisabled == true ? 'cursor-not-allowed':'' " :disabled='isDisabled == true'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4" viewBox="0 0 24 24"><path d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z"/></svg>
                    </image-post-button>
                    <button class="w-10 h-10 rounded-full flex items-center justify-center text-purple-900 hover:text-pink-700" @click="closeModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>
            </template>
        </post-image-modal>
      </form>
    </div>

        
  </div>
</template>

<script>
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import PostImageModal from '@/Pages/Post/PostImage'
import ImagePostButton from '@/Jetstream/Button'


export default {
  components: {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    PostImageModal,
    ImagePostButton
  },
  data() {
            return{
                showable :  false,

                preview : null,

                isDisabled : false,

                form:{
                    post: '',
                    post_image : '',
                    error : ''
                },
            }
        },

        methods :{
            makePost(){

                if(this.form.post.length > 4 || this.form.post_image){
                    this.$inertia.post('/posts/store',this.form);
                    this.form.post = '';
                    this.form.post_image = null;
                    this.preview = null;
                    if(this.showable == true){
                        this.showable = false
                    }
                }
            },

            setImageForPost(){
                
                if (this.$refs.post_upload && !this.form.error) {

                    this.form.post_image = this.$refs.post_upload.files[0]; 

                    this.makePost();
                }

            },

            photoPreview() {

                const fileUpload = this.$refs.post_upload.files[0];
                
                if (fileUpload.size > 1024 * 1024) {
                    this.form.error = 'We cannot upload this size of file at the momment';
                    this.isDisabled = true;
                }else{
                   this.isDisabled = false;
                   this.form.error = '';
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        this.preview = e.target.result;
                    };

                    reader.readAsDataURL(fileUpload); 
                }
            },

            openModal(){
                this.showable = true;
            },

            closeModal(){
                this.showable = false;
                this.form.post = '';
                this.form.post_image = '';
            },

            openFile(){
                
                this.$refs.post_upload.click()
            },
        }
}
</script>