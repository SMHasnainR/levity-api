import React from 'react'
import './style.css'

function Chip({label}) {
  return (
    <p className="chip">
        {label}
    </p>
  )
}

export default Chip