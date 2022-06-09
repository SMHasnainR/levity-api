import React from 'react'
import { Link } from 'react-router-dom'
import Chip from '../../../common/Chip'
import './style.css'

function BlogItem({ 
    blog: {
        id,
        title, 
        author, 
        category,
        authorName,
        authorAvatar,
        description, 
        createdAt,
        cover 
    } }) 
{
  return (
    <div className="blogItem-wrap">
        <img src={cover} alt="Image cover" className='blogItem-cover' />
        
        <Chip label={category} />
        
        <h3>{title}</h3>
        <p className="blogItem-desc">{description}</p>

        <footer>
            <div className="blogItem-author">
                <img src={authorAvatar} alt="avatar" />
                <div>
                    <h6>{authorName}</h6>
                    <p>{createdAt}</p>
                </div>
            </div>
            <Link className="blogItem-link" to={`/blog/${id}`}> &#x2192; </Link>
        </footer>
    </div>
  )
}

export default BlogItem