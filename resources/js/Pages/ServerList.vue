<template>
    <Head title="Server List" />
    <div class="card">
        <!-- Filter Section -->
        <div class="flex flex-wrap mb-4">
            <!-- Storage Filter (Range Slider) -->
            <div class="w-full md:w-1/4 px-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2"
                    >Storage:</label
                >
                <input
                    v-model="filters.storage"
                    type="range"
                    min="0"
                    max="1000"
                    class="slider"
                    id="storageRange"
                />
                <p>{{ filters.storage }} GB</p>
            </div>

            <!-- RAM Filter (Checkboxes) -->
            <div class="w-full md:w-1/4 px-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2"
                    >RAM:</label
                >
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="2" />
                    2GB
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="4" />
                    4GB
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="8" />
                    8GB
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="12" />
                    12GB
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="16" />
                    16GB
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="24" />
                    24GB
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="32" />
                    32GB
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="48" />
                    48GB
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="64" />
                    64GB
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" v-model="filters.ram" value="96" />
                    96GB
                </label>
            </div>

            <!-- Harddisk Type Filter (Dropdown) -->
            <div class="w-full md:w-1/4 px-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2"
                    >Harddisk Type:</label
                >
                <select
                    v-model="filters.harddisk_type"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                >
                    <option value="SAS">SAS</option>
                    <option value="SATA">SATA</option>
                    <option value="SSD">SSD</option>
                </select>
            </div>

            <!-- Location Filter (Dropdown) -->
            <div class="w-full md:w-1/4 px-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2"
                    >Location:</label
                >
                <select
                    v-model="filters.location"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                >
                    <option value="Washington D.C.WDC-01">
                        Washington D.C.WDC-01
                    </option>
                    <option value="AmsterdamAMS-01">AmsterdamAMS-01</option>
                    <option value="Hong KongHKG-10">Hong KongHKG-10</option>
                    <option value="SingaporeSIN-11">SingaporeSIN-11</option>
                    <option value="FrankfurtFRA-10">FrankfurtFRA-10</option>
                    <option value="San FranciscoSFO-12">
                        San FranciscoSFO-12
                    </option>
                    <option value="DallasDAL-10">DallasDAL-10</option>
                </select>
            </div>

            <!-- Fetch Button -->
            <div class="w-full px-2 mb-4">
                <button
                    @click="fetchServers"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Fetch Servers
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            ID
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Model
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            RAM
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Hard Drive
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Location
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="server in servers.data" :key="server.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ server.id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ server.model }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ server.ram }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ server.hdd }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ server.location }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ server.price }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-between mt-4">
            <Link v-if="servers.prev_page_url" :href="servers.prev_page_url">
                <button
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700"
                >
                    Previous
                </button>
            </Link>
            <Link v-if="servers.next_page_url" :href="servers.next_page_url">
                <button
                    v-if="servers.next_page_url"
                    :href="servers.next_page_url"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700"
                >
                    Next
                </button>
            </Link>
        </div>
    </div>
</template>

<script>
import { usePage, Head, Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Head,
        Link,
    },
    data() {
        return {
            filters: {
                storage: 0,
                ram: [],
                harddisk_type: "",
                location: "",
            },
            servers: this.$page.props.servers || [],
        };
    },
    methods: {
        async fetchServers() {
            this.servers = await this.$inertia.get(
                "/api/servers",
                this.filters
            );
        },
    },
};
</script>
<style scoped>
.card {
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    padding: 20px;
}
</style>
