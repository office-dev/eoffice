module.exports = {
  preset: '@vue/cli-plugin-unit-jest',
  testMatch: [
    "**/src/**/*.spec.(js|jsx|ts|tsx)"
  ],
  collectCoverage: true,
  collectCoverageFrom: [
      "**/src/**/*.(js|jsx|ts|vue)",
      "!**/src/**/*.spec.js"
  ]
}
