<template>
  <div class="py-4 container-fluid">
    <div class="row mb-4">
      <div class="col-lg-12 position-relative z-index-2">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <mini-statistics-card :title="{ text: 'Today\'s Money', value: '$53k' }"
              detail="<span class='text-success text-sm font-weight-bolder'>+55%</span> than last week" :icon="{
                name: 'weekend',
                color: 'text-white',
                background: 'dark',
              }" />
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4">
            <mini-statistics-card :title="{ text: 'Today\'s Users', value: '2,300' }"
              detail="<span class='text-success text-sm font-weight-bolder'>+3%</span> than last month" :icon="{
                name: 'leaderboard',
                color: 'text-white',
                background: 'primary',
              }" />
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4">
            <mini-statistics-card :title="{ text: 'New Clients', value: '3,462' }"
              detail="<span class='text-danger text-sm font-weight-bolder'>-2%</span> than yesterday" :icon="{
                name: 'person',
                color: 'text-white',
                background: 'success',
              }" />
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4">
            <mini-statistics-card :title="{ text: 'Sales', value: '$103,430' }"
              detail="<span class='text-success text-sm font-weight-bolder'>+5%</span> Just updated" :icon="{
                name: 'weekend',
                color: 'text-white',
                background: 'info',
              }" />
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-4 col-md-6 mt-4">
            <chart-holder-card title="Transactions" subtitle=""
              :update="'updated ' + moment(transactionsData.lastUpdatedAt).fromNow()">
              <reports-bar-chart id="transactions-chart" :chart="{
                labels: transactionsData.labels,
                datasets: {
                  label: 'Transactions',
                  data: transactionsData.values,
                },
              }" />
            </chart-holder-card>
          </div>
          <div class="col-lg-4 col-md-6 mt-4">
            <chart-holder-card title="Total Ins" subtitle=""
              :update="'updated ' + moment(insData.lastUpdatedAt).fromNow()" color="success">
              <reports-line-chart id="total-ins-chart" :chart="{
                labels: insData.labels,
                datasets: {
                  label: 'INs',
                  data: insData.values,
                },
              }" />
            </chart-holder-card>
          </div>
          <div class="col-lg-4 mt-4">
            <chart-holder-card title="Total Outs" subtitle=""
              :update="'updated ' + moment(outsData.lastUpdatedAt).fromNow()" color="dark">
              <reports-line-chart id="total-outs-chart" :chart="{
                labels: outsData.labels,
                datasets: {
                  label: 'OUTs',
                  data: outsData.values,
                },
              }" />
            </chart-holder-card>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-4 col-md-6 mt-4">
            <chart-holder-card title="Top Products" subtitle=""
              :update="'updated ' + moment(productsData.lastUpdatedAt).fromNow()">
              <reports-bar-chart id="products-chart" :chart="{
                labels: productsData.labels,
                datasets: {
                  label: 'Products',
                  data: productsData.values,
                },
              }" />
            </chart-holder-card>
          </div>
          <div class="col-lg-4 mt-4">
            <chart-holder-card title="Hot Products" subtitle=""
              :update="'updated ' + moment(hotProductsData.lastUpdatedAt).fromNow()" color="dark">
              <reports-polar-area-chart id="tasks-chart" :chart="{
                labels: hotProductsData.labels,
                datasets: {
                  label: 'OUTs',
                  data: hotProductsData.values,
                },
              }" />
            </chart-holder-card>
          </div>
          <div class="col-lg-4 col-md-6 mt-4">
            <chart-holder-card title="Most warehouse occupying products" subtitle=""
              :update="'updated ' + moment(productsData.lastUpdatedAt).fromNow()" color="success">
              <reports-doughnut-chart :chart="{
                labels: productsData.labels,
                datasets: {
                  label: 'INs',
                  data: productsData.values,
                },
              }" />
            </chart-holder-card>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-6 mb-md-0 mb-4">this
        this
        <project-card title="Projects"
          description="<i class='fa fa-check text-info' aria-hidden='true'></i> <span class='font-weight-bold ms-1'>30 done</span> this month"
          :headers="['Companies', 'Members', 'Budget', 'Progress']" :projects="[
            {
              logo: logoXD,
              title: 'Material XD Material XD Version',
              members: [team1, team2, team3, team4],
              budget: '$14,000',
              progress: { percentage: 60, color: 'info' },
            },
            {
              logo: logoAtlassian,
              title: 'Add Progress Track',
              members: [team2, team4],
              budget: '$3,000',
              progress: { percentage: 10, color: 'info' },
            },
            {
              logo: logoSlack,
              title: 'Fix Platform Errors',
              members: [team3, team1],
              budget: 'Not set',
              progress: { percentage: 100, color: 'success' },
            },
            {
              logo: logoSpotify,
              title: 'Launch our Mobile App',
              members: [team4, team3, team4, team1],
              budget: '$20,500',
              progress: { percentage: 100, color: 'success' },
            },
            {
              logo: logoJira,
              title: 'Add the New Pricing Page',
              members: [team4],
              budget: '$500',
              progress: { percentage: 25, color: 'info' },
            },
            {
              logo: logoJira,
              title: 'Redesign New Online Shop',
              members: [team1, team4],
              budget: '$2,000',
              progress: { percentage: 40, color: 'info' },
            },
          ]" />
      </div>
      <div class="col-lg-4 col-md-6">
        <timeline-list class="h-100" title="Orders overview" description="<i class='fa fa-arrow-up text-success' aria-hidden='true'></i>
        <span class='font-weight-bold'>24%</span> this month">
          <timeline-item :icon="{
            component: 'notifications',
            class: 'text-success',
          }" title="$2400 Design changes" date-time="22 DEC 7:20 PM" />
          <TimelineItem :icon="{
            component: 'code',
            class: 'text-danger',
          }" title="New order #1832412" date-time="21 DEC 11 PM" />
          <TimelineItem :icon="{
            component: 'shopping_cart',
            class: 'text-info',
          }" title="Server payments for April" date-time="21 DEC 9:34 PM" />
          <TimelineItem :icon="{
            component: 'credit_card',
            class: 'text-warning',
          }" title="New card added for order #4395133" date-time="20 DEC 2:20 AM" />
          <TimelineItem :icon="{
            component: 'vpn_key',
            class: 'text-primary',
          }" title="Unlock packages for development" date-time="18 DEC 4:54 AM" class="pb-1" />
        </timeline-list>
      </div>
    </div>
  </div>
</template>
<script>
import ChartHolderCard from "./components/ChartHolderCard.vue";
import ReportsBarChart from "../examples/Charts/ReportsBarChart.vue";
import ReportsLineChart from "../examples/Charts/ReportsLineChart.vue";
import ReportsDoughnutChart from "../examples/Charts/ReportsDoughnutChart.vue";
import ReportsPolarAreaChart from "../examples/Charts/ReportsPolarAreaChart.vue";

import MiniStatisticsCard from "./components/MiniStatisticsCard.vue";
import ProjectCard from "./components/ProjectCard.vue";
import TimelineList from "../examples/Cards/TimelineList.vue";
import TimelineItem from "../examples/Cards/TimelineItem.vue";
import logoXD from "../assets/img/small-logos/logo-xd.svg";
import logoAtlassian from "../assets/img/small-logos/logo-atlassian.svg";
import logoSlack from "../assets/img/small-logos/logo-slack.svg";
import logoSpotify from "../assets/img/small-logos/logo-spotify.svg";
import logoJira from "../assets/img/small-logos/logo-jira.svg";
import logoInvision from "../assets/img/small-logos/logo-invision.svg";
import team1 from "../assets/img/team-1.jpg";
import team2 from "../assets/img/team-2.jpg";
import team3 from "../assets/img/team-3.jpg";
import team4 from "../assets/img/team-4.jpg";
import axios from "axios";
import moment from "moment";

export default {
  name: "dashboard-default",
  data() {
    return {
      logoXD,
      team1,
      team2,
      team3,
      team4,
      logoAtlassian,
      logoSlack,
      logoSpotify,
      logoJira,
      logoInvision,

      productsData: { labels: [], values: [], lastUpdatedAt: null },
      hotProductsData: { labels: [], values: [], lastUpdatedAt: null },
      insData: { labels: [], values: [], lastUpdatedAt: null },
      outsData: { labels: [], values: [], lastUpdatedAt: null },
      transactionsData: { labels: [], values: [], lastUpdatedAt: null },
    };
  },
  components: {
    ChartHolderCard,
    ReportsBarChart,
    ReportsLineChart,
    ReportsDoughnutChart,
    ReportsPolarAreaChart,

    MiniStatisticsCard,
    ProjectCard,
    TimelineList,
    TimelineItem,
  },
  methods: {
    moment,
  },
  mounted() {
    axios.get('/api/charts/transactions').then(response => {
      const data = response.data.transactions
      this.transactionsData = {
        labels: data.map(i => moment(i.transaction_date).format('MMM D')),
        values: data.map(i => parseInt(i.c_all)),
        lastUpdatedAt: moment()
      };
    })

    axios.get('/api/charts/ins').then(response => {
      const data = response.data.ins
      this.insData = {
        labels: data.map(i => moment(i.transaction_date).format('MMM D')),
        values: data.map(i => parseInt(i.s_quantity)),
        lastUpdatedAt: moment()
      };
    })

    axios.get('/api/charts/outs').then(response => {
      const data = response.data.outs
      this.outsData = {
        labels: data.map(i => moment(i.transaction_date).format('MMM D')),
        values: data.map(i => parseInt(i.s_quantity)),
        lastUpdatedAt: moment()
      };
    })

    axios.get('/api/charts/top-products').then(response => {
      const data = response.data.top_products
      this.productsData = {
        labels: data.map(i => i.name.split(' ').map(a => a.substring(0, 1)).join('.').toUpperCase()),
        values: data.map(i => i.quantity),
        lastUpdatedAt: moment()
      };
    })

    axios.get('/api/charts/hot-products').then(response => {
      const data = response.data.hot_products
      this.hotProductsData = {
        labels: data.map(i => i.name.split(' ').map(a => a.substring(0, 1)).join('.').toUpperCase()),
        values: data.map(i => i.c_all),
        lastUpdatedAt: moment()
      };
    })
  },
};
</script>
