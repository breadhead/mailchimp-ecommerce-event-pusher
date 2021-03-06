<?php
namespace breadhead\mailchimp\api;

class ProductsBh extends EcommerceEntity
{
    public function updateProduct($storeId, $productId, array $data = [])
    {
        return $this->client->execute("PATCH", "ecommerce/stores/{$storeId}/products/{$productId}", $data);
    }

    public function createProduct($storeId, array $data = [])
    {
        return $this->client->execute("POST", "ecommerce/stores/{$storeId}/products", $data);

    }

    public function getProducts($store_id, array $query = [])
    {
        return $this->client->execute("GET", "ecommerce/stores/{$store_id}/products", $query);
    }

    public function getProduct($store_id, $product_id, array $query = [])
    {
        return $this->client->execute("GET", "ecommerce/stores/{$store_id}/products/{$product_id}", $query);
    }

    public function addProduct($store_id, $product_id, $title, array $variants = [], array $optional_settings = null)
    {
        $optional_fields = ["handle", "url", "description", "type", "vendor", "image_url", "published_at_foreign"];
        $data = [
            "id" => $product_id,
            "title" => $title,
            "variants" => $variants
        ];

        // If the optional fields are passed, process them against the list of optional fields.
        if (isset($optional_settings)) {
            $data = array_merge($data, self::optionalFields($optional_fields, $optional_settings));
        }
        return $this->client->execute("POST", "ecommerce/stores/{$store_id}/products", $data);
    }

    public function getVariants($store_id, $product_id, array $query = [])
    {
        return $this->client->execute("GET", "ecommerce/stores/{$store_id}/products/{$product_id}/variants", $query);
    }

    /**
     * Get information about a specific product variant.
     *
     * @param string $store_id
     * @param string $product_id
     * @param string $variant_id
     * @param  array (optional) $query
     * @return object
     */
    public function getVariant($store_id, $product_id, $variant_id, array $query = [])
    {
        return $this->client->execute("GET", "ecommerce/stores/{$store_id}/products/{$product_id}/variants/{$variant_id}", $query);
    }

    /**
     * Add a new variant to the product.
     *
     * @param string $store_id
     * @param string $product_id
     * @param string $variant_id
     * @param string title.
     * @param array (optional) $optional_settings
     * @return object
     * TODO: expand comment
     */
    public function addVariant($store_id, $product_id, $variant_id, $title, array $optional_settings = [])
    {
        $optional_fields = ["url", "sku", "price", "inventory_quantity", "image_url", "backorders", "visibility"];
        $data = [
            "id" => $variant_id,
            "title" => $title
        ];
        // If the optional fields are passed, process them against the list of optional fields.
        if (isset($optional_settings)) {
            $data = array_merge($data, $this->optionalFields($optional_fields, $optional_settings));
        }
        return $this->client->execute("POST", "ecommerce/stores/{$store_id}/products/{$product_id}/variants", $data);
    }

    /**
     * Add or update a product variant.
     *
     * @param string $store_id
     * @param string $product_id
     * @param string $variant_id
     * @param array $data
     * @return object
     */
    public function upsertVariant($store_id, $product_id, $variant_id, array $data = [])
    {
        return $this->client->execute("PUT", "ecommerce/stores/{$store_id}/products/{$product_id}/variants/{$variant_id}", $data);
    }

    /**
     * Update a product variant.
     *
     * @param string $store_id
     * @param string $product_id
     * @param string $variant_id
     * @param array $data
     * @return object
     */
    public function updateVariant($store_id, $product_id, $variant_id, array $data = [])
    {
        return $this->client->execute("PATCH", "ecommerce/stores/{$store_id}/products/{$product_id}/variants/{$variant_id}", $data);
    }

    /**
     * Delete a product variant.
     *
     * @param string $store_id
     * @param string $product_id
     * @param string variant_id
     */
    public function deleteVariant($store_id, $product_id, $variant_id)
    {
        return $this->client->execute("DELETE", "ecommerce/stores/{$store_id}/products/{$product_id}/variants/{$variant_id}");
    }

    /**
     * Delete a product.
     *
     * @param string $store_id
     * @param string $product_id
     */
    public function deleteProduct($store_id, $product_id)
    {
        return $this->client->execute("DELETE", "ecommerce/stores/{$store_id}/products/{$product_id}");
    }

}
