exports.handler = async (event) => {
    try {

      const {PayloadData} = event        
      const bf = Buffer.from(PayloadData, 'base64')
      
      let payload = {}
      payload.date_time = new Date().toISOString().slice(0, 19).replace('T', ' ');
      payload.raw = bf.toString('hex')
      
      let BAT_STATUS = bf.readUInt8(0) >> 6
      switch (BAT_STATUS) {
          case 0:
              payload.BAT_STATUS = 'Ultra Low'
              break
          case 1:
              payload.BAT_STATUS = 'Low'
          case 2:
              payload.BAT_STATUS = 'OK'
              break
          case 3:
              payload.BAT_STATUS = 'Good'
          default:
              break
      }
      payload.BAT_LEVEL = (bf.readUInt16BE(0) & 0x3FFF)
      payload.TEMPERATURE = (bf.readUInt16BE(2)) / 10
      payload.HUMIDITY = bf[4]
    
      console.log(payload)
      
      return {
         "payload" : payload
      }
  } catch (e) {
      console.log(e)
  }
}