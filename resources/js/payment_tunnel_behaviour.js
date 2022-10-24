$(function() {
	Livewire.on('goToPaymentStep1', function() {
		let element = document.getElementById("payment-tunnel-block-1");
		let y = element.getBoundingClientRect().top + window.pageYOffset - 160;

		window.scrollTo({top: y, behavior: 'smooth'});
		// document.getElementById("payment-tunnel-block-1").scrollIntoView({ behavior: "smooth", block: "start" });
	});

	Livewire.on('goToPaymentStep2', function() {
		let element = document.getElementById("payment-tunnel-block-2");
		let y = element.getBoundingClientRect().top + window.pageYOffset - 160;

		window.scrollTo({top: y, behavior: 'smooth'});
		// document.getElementById("payment-tunnel-block-2").scrollIntoView({ behavior: "smooth", block: "start" });
	});

	Livewire.on('goToPaymentStep3', function() {
		let element = document.getElementById("payment-tunnel-block-3");
		let y = element.getBoundingClientRect().top + window.pageYOffset - 160;

		window.scrollTo({top: y, behavior: 'smooth'});
		// document.getElementById("payment-tunnel-block-3").scrollIntoView({ behavior: "smooth", block: "start" });
	});
})