<template>
  <v-container class="fill-height">
    <v-responsive class="d-flex align-start text-center fill-height mt-10">
      <div class="table-container">
        <div class="top-table d-flex justify-space-between my-4">
          <div class="month-display text-h5">
            {{ monthName[month] }} {{ year }}
          </div>
          <div class="controls d-flex justify-end flex-row">
            <v-btn
              variant="tonal"
              class="mx-1"
              min-width="24"
              color="primary"
              :disabled="
                month === new Date().getMonth() &&
                year === new Date().getFullYear()
              "
              @Click="onCurrentDate"
            >
              <v-icon icon="mdi-calendar" size="22"></v-icon>
            </v-btn>
            <v-btn
              variant="tonal"
              class="mx-1"
              min-width="24"
              color="warning"
              @Click="onPreviousMonth"
            >
              <v-icon icon="mdi-chevron-left"></v-icon>
            </v-btn>
            <v-btn
              variant="tonal"
              class="mx-1"
              min-width="24"
              color="warning"
              @Click="onNextMonth"
            >
              <v-icon icon="mdi-chevron-right"></v-icon>
            </v-btn>
          </div>
        </div>
        <div class="table">
          <div class="table-head d-flex">
            <div
              class="box text-center py-4"
              v-for="(item, index) of daysName"
              :key="index"
            >
              {{ item }}
            </div>
          </div>
          <div class="table-body">
            <div
              class="box fill-col"
              v-for="(item, index) of beforeDays"
              :key="index"
            >
              {{ item }}
            </div>
            <div
              class="box day"
              @click="onSelectDate(index)"
              v-for="(item, index) of days"
              :key="index"
            >
              {{ index + 1 }}
            </div>
            <div
              class="box fill-col"
              v-for="(item, index) of afterDays"
              :key="index"
            >
              {{ item }}
            </div>
          </div>
        </div>
        <div class="select-date-display text-center my-4">{{ selectDate }}</div>
      </div>
    </v-responsive>
  </v-container>
</template>

<script lang="ts">
export default {
  data() {
    let month = new Date().getMonth();
    let year = new Date().getFullYear();
    let days: boolean[] = [];
    let beforeDays: string[] = [];
    let afterDays: string[] = [];
    let selectDate: string = "Click some day in calendar!";
    return {
      daysName: ["Mon", "Tues", "Wed", "Thurs", "Fri", "Sat", "Sun"],
      monthName: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
      year: year,
      month: month,
      beforeDays: beforeDays,
      afterDays: afterDays,
      days: days,
      selectDate: selectDate,
    };
  },
  methods: {
    onLoadCalendar() {
      this.getDays();
      this.getBeforeDays();
      this.getAfterDays();
    },
    getDays() {
      const days = new Date(this.year, this.month + 1, 0).getDate();
      const daysArray = new Array(days).fill(false);
      this.days = daysArray;
    },
    getBeforeDays() {
      const beforeMonth = new Date(this.year, this.month, 0).getDay();
      const daysBefore =
        beforeMonth != 0
          ? new Array(beforeMonth).fill("")
          : new Array(6).fill("");
      this.beforeDays = daysBefore;
    },
    getAfterDays() {
      const afterMonth = new Date(this.year, this.month + 1, 0).getDay();
      const daysAfter =
        afterMonth != 0 ? new Array(7 - afterMonth).fill("") : [];
      this.afterDays = daysAfter;
    },
    onSelectDate(day: number) {
      const date = new Date(this.year, this.month, day + 1);
      this.selectDate = `Your select date : ${date.toString().slice(3, 16)}`;
    },
    onCurrentDate() {
      this.month = new Date().getMonth();
      this.year = new Date().getFullYear();
      this.onLoadCalendar();
    },
    onNextMonth() {
      if (this.month == 11) {
        this.month = 0;
        this.year += 1;
      } else {
        this.month += 1;
      }
      this.onLoadCalendar();
    },
    onPreviousMonth() {
      if (this.month == 0) {
        this.month = 11;
        this.year -= 1;
      } else {
        this.month -= 1;
      }
      this.onLoadCalendar();
    },
  },
  mounted() {
    this.onLoadCalendar();
  },
};
</script>

<style scoped>
.table-container {
  max-width: 700px;
  margin: 1rem auto 0 auto;
  user-select: none;
}

.table {
  border: thin solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 5px;
}

.box {
  font-size: 20px;
  width: 100px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.box.day,
.box.fill-col {
  height: 80px;
}

.box.day {
  cursor: pointer;
}

.table-body {
  display: grid;
  grid-template-columns: repeat(7, 100px);
}
</style>
