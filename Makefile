dev:
	make -j 2 dev-back dev-front
dev-front:
	pnpm run dev
dev-back:
	php artisan serve
