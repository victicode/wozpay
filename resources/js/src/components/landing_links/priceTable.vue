<template>
	<div class="q-py-md">
		<div>
			<div class="q-mb-xl q-px-md-sm q-px-lg">
				<div class="titlePriceSection">Nuestras tarifas anuales de Woz Payments</div>
				<div class="line_under" />
			</div>
			<div id="table-price">
				<!-- Selectores de tipo de pago -->
				<div class="row q-mb-lg q-mt-md">
					<div class="col-6 q-px-xs q-px-md-lg flex justify-end">
						<button :class="['payment-btn', { active: paymentType === 'annual' }]" @click="paymentType = 'annual'">
							Pago anual (recomendado)
						</button>
					</div>
					<div class="col-6 q-px-xs q-px-md-lg">
						<button :class="['payment-btn', { active: paymentType === 'monthly' }]" @click="paymentType = 'monthly'">
							Pago mensual
						</button>
					</div>
				</div>

				<!-- Selectores de tipo de plan -->
				<div class=" q-mb-lg row q-px-md justify-center">
					<div class="col-4 col-md-2 q-px-sm flex justify-center" v-for="plan in planTypes" :key="plan">
						<button :class="['plan-btn', { active: selectedPlanType === plan }]" @click="selectedPlanType = plan">
							{{ plan }}
						</button>
					</div>
				</div>

				<!-- Tarjetas de planes con carousel -->
				<div class="plans-carousel-wrapper">
					<q-carousel v-model="slide" animated control-type="regular" control-color="orange" control-text-color="white"
						:autoplay="false" class="plans-carousel">
						<q-carousel-slide v-for="plan in filteredPlans" :key="plan.id" :name="plan.id" class="q-pa-sm">
							<div class="plan-card">
								<div class="plan-card__header">
									<div class="plan-card__title">{{ plan.name }}</div>
									<div class="plan-card__price--container">
										<div class="plan-card__price">
											Gs. {{ formatNumber(plan.price) }}
										</div>
										<div class="plan-card__price-period">
											/{{ paymentType === 'annual' ? 'Pago único' : 'Mes' }}
										</div>
									</div>
									<div v-if="paymentType === 'annual' && plan.annualSavings" class="plan-card__savings">
										Te ahorras Gs. {{ formatNumber(plan.annualSavings) }} anuales
									</div>
									<div class="plan-card__description">{{ plan.description }}</div>
								</div>
								<div class="plan-card__features">
									<div v-for="(feature, index) in plan.features" :key="index" class="plan-card__feature">
										<q-icon name="eva-checkmark-circle-2-outline" class="feature-icon" />
										<span>{{ feature }}</span>
									</div>
								</div>
								<button class="plan-card__button" @click="selectPlan(plan)">
									Elegir este plan
								</button>
							</div>
						</q-carousel-slide>
					</q-carousel>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import { storeToRefs } from 'pinia';
import { ref, computed, watch } from 'vue'
import { useRouter } from 'vue-router'
import { useDropshippingStore } from '../../services/store/dropshipping.store';

export default {
	setup() {
		const router = useRouter()
		const paymentType = ref('annual')
		const selectedPlanType = ref('Basico')
		const planTypes = ['Basico', 'Regular', 'Profesional']
		const slide = ref(1)

		const { plans } = storeToRefs(useDropshippingStore())

		const filteredPlans = computed(() => {
			return plans.value
				.filter(plan => plan.type === selectedPlanType.value)
				.map(plan => ({
					...plan,
					price: plan[paymentType.value].price,
					annualSavings: plan[paymentType.value].annualSavings,
					description: plan[paymentType.value].description,
					features: plan[paymentType.value].features
				}))
		})

		// Resetear el slide cuando cambia el tipo de plan seleccionado
		watch([selectedPlanType, filteredPlans], () => {
			if (filteredPlans.value.length > 0) {
				slide.value = filteredPlans.value[0].id
			}
		}, { immediate: true })

		const formatNumber = (num) => {
			return new Intl.NumberFormat('es-PY').format(num)
		}

		const selectPlan = (plan) => {

			router.push('/checkout?plan=' + plan.id)
		}

		return {
			paymentType,
			selectedPlanType,
			planTypes,
			filteredPlans,
			formatNumber,
			selectPlan,
			slide
		}
	},
}
</script>
<style lang="scss">
.titlePriceSection {
	font-family: 'Poppins', sans-serif !important;
	font-size: 2.2rem;
	margin-bottom: 2px;
	color: #2c3e50;
	position: relative;
	display: inline-block;
	text-align: center;
	font-weight: 600;
	width: 100%;
}

.line_under {
	background: #ff7f00;
	height: 3px;
	border-radius: 1rem;
	width: 10%;
	margin: auto;
}

#table-price {
	max-width: 1200px;
	margin: 0 auto;
	padding: 0 1rem;
}

.payment-selectors {
	display: flex;
	gap: 1rem;
	justify-content: center;
	flex-wrap: wrap;
}

.payment-btn {
	padding: 0.75rem 1.5rem;
	border: none;
	border-radius: 1rem;
	font-size: 1rem;
	font-weight: 500;
	cursor: pointer;
	transition: all 0.3s ease;
	background: #e0e0e0;
	color: #666;
	font-family: 'Poppins', sans-serif;

	&.active {
		background: #ff7f00;
		color: white;
	}

	&:hover {
		opacity: 0.9;
	}
}

.plan-selectors {
	display: flex;
	gap: 1rem;
	justify-content: center;
	flex-wrap: wrap;
}

.plan-btn {
	padding: 0.5rem 1.5rem;
	border: 2px solid #e0e0e0;
	border-radius: 1rem;
	font-size: 1rem;
	font-weight: 500;
	cursor: pointer;
	transition: all 0.3s ease;
	background: white;
	color: #666;
	font-family: 'Poppins', sans-serif;

	&.active {
		background: #ff7f00;
		color: white;
		border-color: #ff7f00;
	}

	&:hover {
		opacity: 0.9;
	}
}

.plans-carousel-wrapper {
	max-width: 100%;
	margin: 0 auto;
}

.plans-carousel {
	height: auto;
	min-height: 500px;
	background: transparent;

	& .q-carousel__slide {
		display: flex;
		justify-content: center;
		align-items: center;
	}

	& .q-carousel__control {
		background: rgba(255, 127, 0, 0.8);
		border-radius: 50%;
		width: 40px;
		height: 40px;

		&:hover {
			background: #ff7f00;
		}
	}
}

.plan-card {
	background: white;
	border-radius: 1rem;
	padding: 2rem;
	width: 100%;
	max-width: 400px;
	margin: 0 auto;
	box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
	display: flex;
	flex-direction: column;
	height: 100%;
}

.plan-card__header {
	margin-bottom: 1.5rem;
}

.plan-card__title {
	font-size: 2rem;
	font-weight: 700;
	color: #ff7f00;
	margin-bottom: .7rem;
	font-family: 'Poppins', sans-serif;
}

.plan-card__price--container {
	display: flex;
	align-items: end;
}

.plan-card__price {
	font-size: 2.1rem;
	font-weight: 700;
	color: #2c3e50;
	line-height: 1;
	margin-bottom: 0.28rem;
	font-family: 'Poppins', sans-serif;
}

.plan-card__price-period {
	font-size: 0.9rem;
	color: #999;
	margin-bottom: 0.2rem;
	margin-left: 0.2rem;
}

.plan-card__savings {
	color: #19cd15;
	font-weight: 600;
	font-size: 0.95rem;
	margin-bottom: 0.5rem;
}

.plan-card__description {
	color: #999;
	font-size: 0.9rem;
	margin-bottom: 1.5rem;
}

.plan-card__features {
	flex: 1;
	margin-bottom: 1.5rem;
}

.plan-card__feature {
	display: flex;
	align-items: flex-start;
	gap: 0.75rem;
	margin-bottom: 0.75rem;
	font-size: 0.95rem;
	color: #2c3e50;
	line-height: 1.5;
}

.feature-icon {
	color: #ff7f00;
	font-size: 1.2rem;
	margin-top: 0.1rem;
	flex-shrink: 0;
}

.plan-card__button {
	width: 100%;
	padding: 1rem;
	background: #ff7f00;
	color: white;
	border: none;
	border-radius: 0.75rem;
	font-size: 1.1rem;
	font-weight: 600;
	cursor: pointer;
	transition: all 0.3s ease;
	font-family: 'Poppins', sans-serif;

	&:hover {
		background: #e66f00;
		transform: translateY(-2px);
		box-shadow: 0px 4px 12px rgba(255, 127, 0, 0.3);
	}

	&:active {
		transform: translateY(0);
	}
}

@media screen and (max-width: 768px) {
	.line_under {
		width: 20%;
	}

	.payment-selectors,
	.plan-selectors {
		flex-direction: column;
		align-items: center;
	}

	.payment-btn,
	.plan-btn {
		width: 100%;
		max-width: 300px;

	}

	.plan-btn {
		padding: .5rem;
		font-size: 0.8rem;
	}

	.payment-btn {
		font-size: 0.75rem;
	}

	.plans-carousel-wrapper {
		padding: 0 0.5rem;
	}

	.plans-carousel {
		min-height: 450px;

		& .q-carousel__control {
			width: 35px;
			height: 35px;
		}
	}

	.plan-card {
		max-width: 100%;
		padding: 1.5rem;
	}

	.plan-card__price {
		font-size: 1.79rem;

	}

	.plan-card__description {
		margin-bottom: 0px;
	}

	.plan-card__title {
		font-size: 1.5rem;
	}
}
</style>