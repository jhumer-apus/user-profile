<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const photoInput = ref(null);
const photoPreview = ref(null);

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">

            <div v-if="$page.props.jetstream.managesProfilePhotos" class="m-auto w-fit">
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                    id="photo"
                >

                <InputLabel for="photo" value="Profile photo" class="text-center"/>

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <div class="rounded-full h-20 w-20 object-cover bg-red-100 m-auto"></div>
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center m-auto"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 text-center" type="button" @click.prevent="selectNewPhoto">
                    Add Photo
                </SecondaryButton>

                <!-- <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Remove Photo
                </SecondaryButton> -->
            </div>


            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
