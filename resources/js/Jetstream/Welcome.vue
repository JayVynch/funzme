<template>
    <div>
        <div class="py-6 px-2 md:px-20 bg-white border-b border-gray-200">

            <div class="mt-8 text-2xl flex flex-col w-full items-center">
                <PostBox />

                <Feeds />
            </div>
        </div>

        
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import PostImageModal from '@/Pages/Post/PostImage'
    import Feeds from '@/Pages/Post/Feeds.vue'
    import ImagePostButton from '@/Jetstream/Button'
    import PostBox from '@/Pages/Post/PostBox'

    export default defineComponent({
        components: {
            JetApplicationLogo,
            PostImageModal,
            Feeds,
            ImagePostButton,
            PostBox
        },

        data() {
            return{
                showable :  false,

                preview : null,

                form:{
                    post: '',
                    post_image : '',
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
                
                if (this.$refs.post_upload) {

                    this.form.post_image = this.$refs.post_upload.files[0]; 

                    this.makePost();
                }

            },

            photoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.preview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.post_upload.files[0]);
            },

            openModal(){
                this.showable = true;
            },

            closeModal(){
                this.showable = false;
            },

            openFile(){
                
                this.$refs.post_upload.click()
            },
        }
    })
</script>
