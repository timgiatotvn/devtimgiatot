function range() {
	return {
		minprice: 1000,
		maxprice: 9000,
		min: 0,
		max: 10000,
		minthumb: 0,
		maxthumb: 0,
		mintrigger() {
			this.validation();
			this.minprice = Math.min(this.minprice, this.maxprice - 500);
			this.minthumb = ((this.minprice - this.min) / (this.max - this.min)) * 100;
		},
		maxtrigger() {
			this.validation();
			this.maxprice = Math.max(this.maxprice, this.minprice + 200);
			this.maxthumb = 100 - (((this.maxprice - this.min) / (this.max - this.min)) * 100);
		},
		validation() {
			if (/^\d*$/.test(this.minprice)) {
				if (this.minprice > this.max) {
					this.minprice = 9500;
				}
				if (this.minprice < this.min) {
					this.minprice = this.min;
				}
			} else {
				this.minprice = 0;
			}
			if (/^\d*$/.test(this.maxprice)) {
				if (this.maxprice > this.max) {
					this.maxprice = this.max;
				}
				if (this.maxprice < this.min) {
					this.maxprice = 200;
				}
			} else {
				this.maxprice = 10000;
			}
		}
	}
}


