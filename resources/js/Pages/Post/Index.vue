<template>
	<Head title="Post" />
	<div class="mt-5">
		<div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
			{{ $page.props.flash.message }}
		</div>

		<div class="mb-3">
			<Link href="/posts/create" class="btn btn-md btn-primary">TAMBAH DATA</Link>	
		</div>

		<div class="card border-0 rounded shadows-sm">
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">TITLE</th>
							<th scope="col">CONTENT</th>
							<th scope="col" class="text-center">ACTIONS</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="post in posts" :key="post.id">
							<td>{{ post.title }}</td>
							<td>{{ post.content }}</td>
							<td class="text-center">
								<Link :href="`/posts/${post.id}`" class="btn btn-sm btn-primary me-2">Edit</Link>
								<button @click.prevent="deletePost(`${post.id}`)" class="btn btn-sm btn-danger">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
	import { Head, Link } from '@inertiajs/inertia-vue3'
	import LayoutApp from '../../Layouts/App.vue'
	import { Inertia } from '@inertiajs/inertia'

	export default {
		components: {
	      Head,
	      Link,
	    },
		layout: LayoutApp,
		props: {
			posts: Array
		},
		setup(){
			function deletePost(id){
				if(confirm('Are you sure?')){
					Inertia.delete(`/posts/${id}`)
				}else{
					return
				}
			}

			return {
				deletePost
			}
		}
	}
</script>