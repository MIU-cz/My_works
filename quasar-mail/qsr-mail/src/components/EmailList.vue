<template>
	<div class="email_list">
		<q-list bordered>
			<q-item v-for="email in emails" :key="email.id" clickable>
				<q-item-section avatar>
					<q-avatar color="primary" text-color="white">
						{{ email.fromAddress }}
					</q-avatar>
				</q-item-section>

				<q-item-section>
					<q-item-label>{{ email.subject }}</q-item-label>
					<q-item-label caption>{{ email.messageDt }}</q-item-label>
				</q-item-section>

				<q-item-section>
					<q-item-label>{{ email.text }}</q-item-label>
				</q-item-section>

				<q-item-section side top>
					<q-icon name="star_border" />
				</q-item-section>
			</q-item>
		</q-list>
	</div>
</template>
  
<script>
export default {
	name: "EmailList",
	props: {
		emails: {
			type: Array,
			default: () => [],
		},
	},
};


</script>
  
<style scoped>
.email_list {
	max-width: 600px;
	margin: auto;
}
</style>
  