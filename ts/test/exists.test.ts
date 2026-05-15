
import { test, describe } from 'node:test'
import { equal } from 'node:assert'


import { QuotesSDK } from '..'


describe('exists', async () => {

  test('test-mode', async () => {
    const testsdk = await QuotesSDK.test()
    equal(null !== testsdk, true)
  })

})
