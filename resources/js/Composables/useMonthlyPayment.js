import {computed, isRef} from 'vue'

export const defaultInterestRate = 1.2
export const defaultDuration = 30

export const maxDuration = 30
export const maxInterestRate = 8
export const useMonthlyPayment = (price, interestRate = defaultInterestRate, duration = defaultDuration) => {
    const monthlyPayment = computed(() => {
        const principle = isRef(price) ? price.value : price
        const monthlyInterest = (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12
        const numberOfPaymentMonths = (isRef(duration) ? duration.value : duration ) * 12
        return principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
    })

    const totalPaid = computed(() => (isRef(duration) ? duration.value : duration ) * 12 * monthlyPayment.value)
    const totalInterest = computed(() => totalPaid.value - (isRef(price) ? price.value : price))

    return {monthlyPayment, totalPaid, totalInterest}
}
